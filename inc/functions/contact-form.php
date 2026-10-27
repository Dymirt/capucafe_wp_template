<?php
defined('ABSPATH') || exit;
/** Add visible, associated labels without changing CF7 field names or mail settings. */
add_filter('wpcf7_form_elements', function ($html) {
    if (!is_page_template('page-kontakt.php')) return $html;
    $labels = [
        'imię' => 'Imię',
        'email' => 'Adres e-mail',
        'nr telefonu' => 'Numer telefonu',
        'temat wiadomości' => 'Temat wiadomości',
        'treść wiadomości' => 'Wiadomość',
    ];
    $index = 0;
    return preg_replace_callback('/<(?:input|textarea)\b[^>]*>/i', function ($match) use ($labels, &$index) {
        $textarea = stripos($match[0], '<textarea') === 0;
        $tag = new WP_HTML_Tag_Processor($match[0] . ($textarea ? '</textarea>' : ''));
        $tag->next_tag();
        $placeholder = $tag->get_attribute('placeholder');
        if (!isset($labels[$placeholder])) return $match[0];
        $id = wp_unique_id('ccafe-contact-field-') . '-' . ++$index;
        $tag->set_attribute('id', $id);
        $label = $labels[$placeholder];
        $label .= $tag->get_attribute('aria-required') === 'true' ? ' (wymagane)' : ' (opcjonalnie)';
        $output = $tag->get_updated_html();
        if ($textarea) $output = substr($output, 0, -strlen('</textarea>'));
        return '<label class="ccafe-contact-field-label" for="' . esc_attr($id) . '">' . esc_html($label) . '</label>' . $output;
    }, $html);
});

/** Repair the legacy duplicate subject name in both rendering and REST validation. */
function ccafe_contact_form_properties($properties) {
    $legacy = '[text* text-1101 placeholder "temat wiadomości"]';
    if (!isset($properties['form']) || substr_count($properties['form'], '[text* text-1101 ') < 2 || strpos($properties['form'], $legacy) === false) return $properties;
    $properties['form'] = str_replace($legacy, '[text* ccafe-contact-subject placeholder "temat wiadomości"]', $properties['form']);
    foreach (['mail', 'mail_2'] as $key) {
        if (empty($properties[$key]['body']) || ($key === 'mail_2' && empty($properties[$key]['active']))) continue;
        $body = $properties[$key]['body'];
        $subject = 'Temat: [ccafe-contact-subject]';
        $properties[$key]['body'] = strpos($body, 'Treść wiadomości:') !== false
            ? str_replace('Treść wiadomości:', $subject . "\n\nTreść wiadomości:", $body)
            : $body . "\n\n" . $subject;
    }
    return $properties;
}
add_filter('wpcf7_contact_form_properties', function ($properties, $form) {
    return $form->title() === 'KONTAKT' ? ccafe_contact_form_properties($properties) : $properties;
}, 10, 2);
