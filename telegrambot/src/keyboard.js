const kb = require('./keyboard-buttons')


module.exports = {
    langs: [
        [kb.langs.uz, kb.langs.ru]
    ],
    home_uz: [
        [kb.home.faqs_uz],
        [kb.home.reception_days_uz, kb.home.contacts_uz],
        [kb.home.library_uz],
        [kb.home.statistics_uz, kb.home.settings_uz]
    ],
    home_ru: [
        [kb.home.faqs_ru],
        [kb.home.reception_days_ru, kb.home.contacts_ru],
        [kb.home.library_ru],
        [kb.home.statistics_ru, kb.home.settings_ru]
    ],
    settings_uz: [
        [kb.settings.uz],
        [kb.other.back_uz]
    ],
    settings_ru: [
        [kb.settings.ru],
        [kb.other.back_ru]
    ]
}