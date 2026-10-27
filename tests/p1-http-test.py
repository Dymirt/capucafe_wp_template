"""Local HTTP regression tests; isolated guest cart, no orders or payments."""
import http.cookiejar, urllib.request, urllib.parse, urllib.error, re, json
from html import unescape
from html.parser import HTMLParser
BASE='http://capuccino-dev.local'
class Inputs(HTMLParser):
    def __init__(self, html):
        super().__init__(); self.fields={}; self.cards=[]; self.options=[]; self.feed(html)
    def handle_starttag(self, tag, attrs):
        a=dict(attrs)
        if tag=='input' and a.get('name'): self.fields[a['name']]=a.get('value','')
        if a.get('data-candy-id'): self.cards.append(int(a['data-candy-id']))
        if a.get('data-variation-id'): self.options.append(a)
jar=http.cookiejar.CookieJar(); client=urllib.request.build_opener(urllib.request.HTTPCookieProcessor(jar)); checks=0
def request(path, data=None, hx=False, method=None):
    req=urllib.request.Request(BASE+path, data=urllib.parse.urlencode(data).encode() if data is not None else None, headers={'HX-Request':'true'} if hx else {}, method=method)
    try: response=client.open(req,timeout=30)
    except urllib.error.HTTPError as error: response=error
    return response.status,response.read().decode(),response.geturl()
def check(condition,message):
    global checks
    assert condition,message
    checks+=1
status, html, _=request('/produkt/praliny/?p1-http=1'); parsed=Inputs(html)
check(status==200,'product response')
check('Undefined variable $register' not in html,'no register warning')
nonce=parsed.fields['ccafe_praline_nonce']; product=parsed.fields['product_id']; option=next(x for x in parsed.options if x['data-capacity']=='6')
base={'add-to-cart':product,'product_id':product,'quantity':'1','variation_id':option['data-variation-id'],'attribute_ilosc-sztuk-w-opakowaniu':option['data-value'],'ccafe_praline_nonce':nonce}
for payload in ['[]','null','{bad',json.dumps([{'id':parsed.cards[0],'quantity':-6}]),json.dumps([{'id':9999999,'quantity':6}]),json.dumps([{'id':parsed.cards[0],'quantity':5}])]:
    _,result,_=request('/produkt/praliny/',{**base,'custom_candies':payload})
    check('został dodany do koszyka' not in result,'reject invalid composition')
_,result,_=request('/produkt/praliny/',{**base,'custom_candies':json.dumps([{'id':parsed.cards[0],'name':'FORGED','quantity':6}]),'box_size':'999 sztuk'})
check('został dodany do koszyka' in result,'valid composition accepted')
_,html,_=request('/produkt/praliny/?p1-http=2'); fields=Inputs(html).fields; key=fields['cart_item_key']; nonce=fields['nonce']
cartbase={'action':'ccafe_update_cart_item_qty','nonce':nonce,'cart_item_key':key}
for bad in [None,'-1','1.5','NaN','1000000000']:
    data={**cartbase}
    if bad is not None: data['quantity']=bad
    status,result,_=request('/wp-admin/admin-ajax.php',data,hx=True)
    check(status==422 and 'Podaj prawidłową' in result,'invalid qty rejected with 422')
    check(key in result,'invalid qty preserves line')
status,result,_=request('/wp-admin/admin-ajax.php',{**cartbase,'quantity':2,'cart_item_key':'foreign'},hx=True)
check(status==422 and 'nie istnieje' in result,'foreign key')
status,result,_=request('/wp-admin/admin-ajax.php',{**cartbase,'quantity':2,'nonce':'invalid'},hx=True)
check(status==403 and 'Sesja formularza' in result,'nonce status')
status,result,_=request('/wp-admin/admin-ajax.php',{**cartbase,'quantity[]':'2'},hx=True)
check(status==422,'array quantity rejected')
status,result,_=request('/wp-admin/admin-ajax.php',{**cartbase,'cart_item_key[]':'x','quantity':2},hx=True)
check(status==422,'array key rejected')
status,result,_=request('/wp-admin/admin-ajax.php',{'action':'ccafe_update_cart_item_qty','nonce[]':'x','cart_item_key':key,'quantity':2},hx=True)
check(status==403,'array nonce rejected')
status,result,_=request('/wp-admin/admin-ajax.php?action=ccafe_update_cart_item_qty',hx=True)
check(status==405,'GET mutation rejected')
original_client=client
client=urllib.request.build_opener(urllib.request.HTTPCookieProcessor(http.cookiejar.CookieJar()))
_,other_html,_=request('/produkt/praliny/?p1-http=other-session')
foreign_nonce=Inputs(other_html).fields['ccafe_praline_nonce']
_,foreign_result,_=request('/produkt/praliny/',{**base,'custom_candies':json.dumps([{'id':parsed.cards[0],'quantity':6}])})
check('został dodany do koszyka' not in foreign_result,'praline nonce tied to session')
_,other_result,_=request('/produkt/praliny/',{**base,'ccafe_praline_nonce':foreign_nonce,'custom_candies':json.dumps([{'id':parsed.cards[0],'quantity':6}])})
check('został dodany do koszyka' in other_result,'second session own nonce works')
_,other_html,_=request('/produkt/praliny/?p1-http=other-cart')
other_fields=Inputs(other_html).fields
foreign_cart_nonce=other_fields['nonce']
request('/wp-admin/admin-ajax.php',{'action':'ccafe_update_cart_item_qty','nonce':foreign_cart_nonce,'cart_item_key':other_fields['cart_item_key'],'quantity':0},hx=True)
client=original_client
status,result,_=request('/wp-admin/admin-ajax.php',{**cartbase,'quantity':2,'nonce':foreign_cart_nonce},hx=True)
check(status==403,'foreign nonce rejected')
status,result,_=request('/wp-admin/admin-ajax.php',{**cartbase,'quantity':2},hx=True)
check(status==200 and '60,00' in result and 'hx-swap-oob' in result,'valid HTML update with badge')
status,result,_=request('/wp-admin/admin-ajax.php',{**cartbase,'quantity':1})
check(status==200 and '.ccafe-mini-cart' in json.loads(result)['fragments'],'Woo JSON contract')
status,result,url=request('/wp-admin/admin-post.php',{**cartbase,'quantity':2})
check(status==200 and url.endswith('/koszyk/') and 'Koszyk został zaktualizowany' in result,'plain form fallback')
status,result,_=request('/wp-admin/admin-ajax.php',{**cartbase,'quantity':0},hx=True)
check(status==200 and 'Twój koszyk jest pusty' in result and key not in result,'remove last line')
print(f'PASS: {checks} local HTTP checks')
