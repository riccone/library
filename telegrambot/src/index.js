process.env.NTBA_FIX_319 = 1;
process.env["NTBA_FIX_350"] = 1;
const TelegramBot = require('node-telegram-bot-api');
const config = require('./config');
const helper = require('./helper');
const keyboard = require('./keyboard');
// const fs = require('fs');
var mysql = require('mysql');


helper.logStart();

let globalLang;

var db_config = {
    host: "localhost",
    user: "root",
    password: "",
    database: "telegram_bot"
};

var mysqlClient = mysql.createConnection(db_config); // This is the global MySQL client
handleDisconnect(mysqlClient);

var db_config2 = {
    host: "localhost",
    user: "root",
    password: "",
    database: "library"
};

function handleDisconnect(client) {
    client.on('error', function (error) {
        if (!error.fatal) return;
        if (error.code !== 'PROTOCOL_CONNECTION_LOST') throw err;

        console.error('> Re-connecting lost MySQL connection: ' + error.stack);

        // NOTE: This assignment is to a variable from an outer scope; this is extremely important
        // If this said `client =` it wouldn't do what you want. The assignment here is implicitly changed
        // to `global.mysqlClient =` in node.
        mysqlClient = mysql.createConnection(client.config);
        handleDisconnect(mysqlClient);
        mysqlClient.connect();
    });
}

var mysqlClient2 = mysql.createConnection(db_config2); // This is the global MySQL client
handleDisconnect2(mysqlClient2);

function handleDisconnect2(client) {
    client.on('error', function (error) {
        if (!error.fatal) return;
        if (error.code !== 'PROTOCOL_CONNECTION_LOST') throw err;

        console.error('> Re-connecting lost MySQL connection: ' + error.stack);

        // NOTE: This assignment is to a variable from an outer scope; this is extremely important
        // If this said `client =` it wouldn't do what you want. The assignment here is implicitly changed
        // to `global.mysqlClient =` in node.
        mysqlClient2 = mysql.createConnection(client.config);
        handleDisconnect2(mysqlClient2);
        mysqlClient2.connect();
    });
}

const bot = new TelegramBot(config.TOKEN_TEST, {
    polling: true,
    request: {
        proxy: config.PROXY_DEV,
    },
});

bot.on('message', msg => {
    console.log('Working', msg.from.first_name)
    mysqlClient.query(`SELECT lang FROM t_users where chat_id=${helper.getChatId(msg)};`, function (err, result) {
        if (err) throw err;
        // console.log(result);
        if (result.length !== 0) {
            globalLang = result[0].lang
        }
    });

    switch (msg.text) {
        case '🇺🇿 O\'zbekcha': {
            // globalLang = 'uz';
            mysqlClient.query(`SELECT count(*) as count FROM t_users where chat_id=${helper.getChatId(msg)};`, function (err, result, fields) {
                if (err) throw err;
                console.log(result[0].count);
                if (result[0].count == 0) {
                    var sql = `INSERT INTO t_users (name, data_json, chat_id, lang) VALUES ('${msg.from.first_name + ' ' + msg.from.last_name}',null,'${msg.chat.id}','uz')`;
                    mysqlClient.query(sql, function (err, result) {
                        if (err) throw err;
                        console.log("1 record inserted");
                    });
                } else {
                    var sql = `UPDATE t_users SET lang = 'uz' WHERE (chat_id = ${helper.getChatId(msg)});`;
                    mysqlClient.query(sql, function (err, result) {
                        if (err) throw err;
                        console.log("1 record updated");
                    });
                }
            });

            const text = 'Bosh sahifa:';
            bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text, {
                reply_markup: {
                    resize_keyboard: true,
                    one_time_keyboard: true,
                    keyboard: keyboard.home_uz
                }
            })
        }
            break;
        case '🇷🇺 Русский': {
            // globalLang = 'ru';
            mysqlClient.query(`SELECT count(*) as count FROM t_users where chat_id=${helper.getChatId(msg)};`, function (err, result, fields) {
                if (err) throw err;
                console.log(result[0].count);
                if (result[0].count == 0) {
                    var sql = `INSERT INTO t_users (name, data_json, chat_id, lang) VALUES ('${msg.from.first_name + ' ' + msg.from.last_name}',null,'${msg.chat.id}','ru')`;
                    mysqlClient.query(sql, function (err, result) {
                        if (err) throw err;
                        console.log("1 record inserted");
                    });
                } else {
                    var sql = `UPDATE t_users SET lang = 'ru' WHERE (chat_id = ${helper.getChatId(msg)});`;
                    mysqlClient.query(sql, function (err, result) {
                        if (err) throw err;
                        console.log("1 record updated");
                    });
                }
            });
            const text = 'Главная:';
            bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text, {
                reply_markup: {
                    resize_keyboard: true,
                    one_time_keyboard: true,
                    keyboard: keyboard.home_ru
                }
            })
        }
            break;
        case '❓ Eng ko\'p beriladigan savollar ❓': {
            var arrKeys = [];
            mysqlClient.query("SELECT * FROM categories", function (err, result, fields) {
                if (err) throw err;
                // console.log(result);
                // console.log(arrKeys);
                // return result;
                result.forEach(function (item) {
                    // console.log(item.name_uz)
                    arrKeys.push(
                        [
                            {
                                text: item.name_uz,
                                callback_data: item.key_cat
                            }
                        ]
                    )
                })
                const text = '❓ Eng ko\'p beriladigan savollar :';
                bot.deleteMessage(msg.chat.id, msg.message_id);
                bot.sendMessage(helper.getChatId(msg), text, {
                    reply_markup: {
                        inline_keyboard: arrKeys
                    }
                })
            });
            // console.log(arrKeysFAQCat)


        }
            break;
        case '❓ Часто задаваемые вопросы ❓': {
            var arrKeys = [];
            mysqlClient.query("SELECT * FROM categories", function (err, result, fields) {
                if (err) throw err;
                result.forEach(function (item) {
                    // console.log(item.name_uz)
                    arrKeys.push(
                        [
                            {
                                text: item.name_ru,
                                callback_data: item.key_cat
                            }
                        ]
                    )
                })
                const text = '❓ Часто задаваемые вопросы :';
                bot.deleteMessage(msg.chat.id, msg.message_id);
                bot.sendMessage(helper.getChatId(msg), text, {
                    reply_markup: {
                        inline_keyboard: arrKeys
                    }
                })
            });
            // console.log(arrKeysFAQCat)
            bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text, {
                parse_mode: 'HTML'
            })

        }
            break;
        case '📞 Biz bilan aloqa': {
            var contacts = `✉️ Kanselyariya - Seledsova S.
\n<a href='tel:998712391252'>☎️ +99871 239-12-52</a> 
\n<a href='tel:998712391569'>☎️ +99871 239-15-69</a> 
                                                    \n<a href='tel:998712445643'>☎️ +99871 244-56-43</a>
                                                  \n\n📜 Axborot xizmati - Jurayeva D.
                                                    \n<a href='tel:998712391570'>☎️ +99871 239-15-70</a>
                                                  \n\n🧾 Reception - Ismailova D.
                                                    \n<a href='tel:998712032244'>☎️ +99871 203-22-44</a>
                                                  \n\n📮 Jismoniy va yuridik shaxslarning murojaatlari bilan ishlash bo\`limi - Alimatova O.
                                                    \n<a href='tel:998712391231'>☎️ +99871 239-12-31</a>
                                                    \n<a href='tel:998712391317'>☎️ +99871 239-13-17</a>
                                                    \n<a href='tel:998712394891'>☎️ +99871 239-48-91</a>
                                                  \n\n👮🏼‍♂️ Nazorat bo\`limi - Ergashev D.
                                                    \n<a href='tel:998712391135'>☎️ +99871 239-11-35</a>
                                                    \n<a href='tel:998712394593'>☎️ +99871 239-45-93</a>
                                                    \n<a href='tel:998712394439'>☎️ +99871 239-44-39</a>
                                                  \n\n📞 Call center
                                                    \n<a href='tel:998712030050'>☎️ +99871 203-00-50</a>`;

            bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), contacts, {
                parse_mode: 'HTML'
            })

        }
            break;
        case '📞 Связаться с нами': {
            var contacts = `✉️ Канцелярия - Селедцова С.
                                                    \n<a href='tel:998712391252'>☎️ +99871 239-12-52</a> 
                                                    \n<a href='tel:998712391569'>☎️ +99871 239-15-69</a> 
                                                    \n<a href='tel:998712445643'>☎️ +99871 244-56-43</a>
                                                  \n\n📜 Информационная служба - Джураева Д.
                                                    \n<a href='tel:998712391570'>☎️ +99871 239-15-70</a>
                                                  \n\n🧾 Reception - Исмаилова Д.
                                                    \n<a href='tel:998712032244'>☎️ +99871 203-22-44</a>
                                                  \n\n📮 Отдел по работе с обращениями физических и юридических лиц - Алиматова О.
                                                    \n<a href='tel:998712391231'>☎️ +99871 239-12-31</a>
                                                    \n<a href='tel:998712391317'>☎️ +99871 239-13-17</a>
                                                    \n<a href='tel:998712394891'>☎️ +99871 239-48-91</a>
                                                  \n\n👮🏼‍♂️ Отдел контроля - Эргашев Д.
                                                    \n<a href='tel:998712391135'>☎️ +99871 239-11-35</a>
                                                    \n<a href='tel:998712394593'>☎️ +99871 239-45-93</a>
                                                    \n<a href='tel:998712394439'>☎️ +99871 239-44-39</a>
                                                  \n\n📞 Call center
                                                    \n<a href='tel:998712030050'>☎️ +99871 203-00-50</a>`;

            bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), contacts, {
                parse_mode: 'HTML'
            })

        }
            break;
        case '📆 Дни приема руководства': {
            var text_head = `<b>ГРАФИК приёма физических лиц и представителей юридических лиц в Министерстве финансов Республики Узбекистан</b>`;

            // bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text_head, {
                parse_mode: 'HTML'
            })
            bot.sendPhoto(helper.getChatId(msg), './src/images/Qabul-ru.JPG')
            bot.sendDocument(helper.getChatId(msg), './src/files/sayyor_qabul.pdf')
            bot.sendMessage(helper.getChatId(msg), `<b>Примечание</b>: Запись на приём к руководству Министерства финансов осуществляется также на веб-сайте <a href="www.mf.uz">www.mf.uz</a>, также по телефону: <a href="tel:+998 (71) 203-00-50">+998 (71) 203-00-50</a>`, {
                parse_mode: 'HTML'
            })

        }
            break;
        case '📆 Rahbariyat qabul kunlari': {
            var text_head = `<b>O'zbekiston Respublikasi Moliya vazirligi huzuridagi jismoniy va yuridik shaxslari vakillarining kundalik qabuli rejasi</b>`;

            // bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text_head, {
                parse_mode: 'HTML'
            });
            // console.log(_dirname)
            bot.sendPhoto(helper.getChatId(msg), './src/images/Qabul-uz.JPG');
            bot.sendDocument(helper.getChatId(msg), './src/files/sayyor_qabul.pdf');
            bot.sendMessage(helper.getChatId(msg), `<b>Izoh</b>: Moliya vazirligining rahbariyati qabuliga <a href="www.mf.uz">www.mf.uz</a>  sayti orqali, shuningdek quyidagi telefon raqamlari bilan bog'lanib ma'lumot olinadi:    <a href="tel:+998 (71) 203-00-50">+998 (71) 203-00-50</a>`, {
                parse_mode: 'HTML'
            })

        }
            break;
        case '⚙️ Sozlamalar': {
            var text_head = `⚙️ Sozlamalar`;

            // bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text_head, {
                reply_markup: {
                    resize_keyboard: true,
                    one_time_keyboard: true,
                    keyboard: keyboard.settings_uz
                }
            })
            // console.log(_dirname)
            // bot.sendPhoto(helper.getChatId(msg), '/src/images/Qabul-uz.JPG')

        }
            break;
        case '⚙️ Настройки': {
            var text_head = `⚙️ Настройки`;

            // bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text_head, {
                reply_markup: {
                    resize_keyboard: true,
                    one_time_keyboard: true,
                    keyboard: keyboard.settings_ru
                }
            })
            // console.log(_dirname)
            // bot.sendPhoto(helper.getChatId(msg), '/src/images/Qabul-uz.JPG')

        }
            break;
        case '🌐 Tilni o\'zgartirish': {
            var text_head = `⚙️ Sozlamalar`;

            // bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text_head, {
                reply_markup: {
                    resize_keyboard: true,
                    one_time_keyboard: true,
                    keyboard: keyboard.langs
                }
            })
            // console.log(_dirname)
            // bot.sendPhoto(helper.getChatId(msg), '/src/images/Qabul-uz.JPG')

        }
            break;
        case '🌐 Изменение языка': {
            var text_head = `⚙️ Настройки`;

            // bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text_head, {
                reply_markup: {
                    resize_keyboard: true,
                    one_time_keyboard: true,
                    keyboard: keyboard.langs
                }
            })
            // console.log(_dirname)
            // bot.sendPhoto(helper.getChatId(msg), '/src/images/Qabul-uz.JPG')

        }
            break;
        case '⬅️ Bosh sahifa': {
            var text_head = `⚙️ Sozlamalar`;

            // bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text_head, {
                reply_markup: {
                    resize_keyboard: true,
                    one_time_keyboard: true,
                    keyboard: keyboard.home_uz
                }
            })
            // console.log(_dirname)
            // bot.sendPhoto(helper.getChatId(msg), '/src/images/Qabul-uz.JPG')

        }
            break;
        case '⬅️ Главная': {
            var text_head = `⚙️ Настройки`;

            // bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text_head, {
                reply_markup: {
                    resize_keyboard: true,
                    one_time_keyboard: true,
                    keyboard: keyboard.home_ru
                }
            })
            // console.log(_dirname)
            // bot.sendPhoto(helper.getChatId(msg), '/src/images/Qabul-uz.JPG')

        }
            break;
        case '📚 Elektron kutubxona': {
            var arrKeys = [];
            mysqlClient2.query("SELECT * FROM category_books WHERE id != 0", function (err, result, fields) {
                if (err) throw err;
                result.forEach(function (item) {
                    // console.log(item.name_uz)
                    arrKeys.push(
                        [
                            {
                                text: item.name,
                                callback_data: item.key_cat
                            }
                        ]
                    )
                })
                const text = '📚 Elektron kutubxona';
                //bot.deleteMessage(msg.chat.id, msg.message_id);
                bot.sendMessage(helper.getChatId(msg), text, {
                    reply_markup: {
                        inline_keyboard: arrKeys
                    }
                })
            });
            // console.log(arrKeysFAQCat)
            //bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text, {
                parse_mode: 'HTML'
            })
        } break;
        case '📚 Электронная библиотека': {
            var arrKeys = [];
            mysqlClient2.query("SELECT * FROM category_books WHERE id != 0", function (err, result, fields) {
                if (err) throw err;
                result.forEach(function (item) {
                    // console.log(item.name_uz)
                    arrKeys.push(
                        [
                            {
                                text: item.name,
                                callback_data: item.key_cat
                            }
                        ]
                    )
                })
                const text = '📚 Электронная библиотека';
                //bot.deleteMessage(msg.chat.id, msg.message_id);
                bot.sendMessage(helper.getChatId(msg), text, {
                    reply_markup: {
                        inline_keyboard: arrKeys
                    }
                })
            });
            // console.log(arrKeysFAQCat)
            //bot.deleteMessage(msg.chat.id, msg.message_id);
            bot.sendMessage(helper.getChatId(msg), text, {
                parse_mode: 'HTML'
            })
        } break;
    }
})

bot.on('callback_query', query => {
    var key = query.data.slice(0, 3);
    if (key == 'cat') {
        var arrKeys = [];
        mysqlClient.query(`SELECT * FROM categories where key_cat like '${query.data}';`, function (err, result, fields) {
            if (err) throw err;
            mysqlClient.query(`SELECT * FROM faqs where category_id=${result[0].id}`, function (err, result2) {
                if (err) throw err;
                // console.log(result2);
                result2.forEach(function (item) {
                    // console.log(item.name_uz)
                    arrKeys.push(
                        [
                            {
                                text: (globalLang === 'uz') ? item.question_uz : item.question_ru,
                                callback_data: item.faq_key
                            }
                        ]
                    )
                })
                bot.deleteMessage(query.message.chat.id, query.message.message_id);
                const text = (globalLang === 'uz') ? `${result[0].name_uz} bo'limi bo'yicha savollar:` : `Вопросы по разделу ${result[0].name_ru}:`;
                bot.sendMessage(query.message.chat.id, text, {
                    reply_markup: {
                        inline_keyboard: arrKeys
                    }
                })
            });
        });
    }
    if (key == 'faq') {
        mysqlClient.query(`SELECT * FROM faqs where faq_key like '${query.data}';`, function (err, result, fields) {
            if (err) throw err;
            bot.deleteMessage(query.message.chat.id, query.message.message_id);
            const text = (globalLang === 'uz') ? `❓ Savol: ${result[0].question_uz}\n\n✅ Javob: ${result[0].answer_uz}` : `❓ Вопрос: ${result[0].question_ru}\n\n✅ Ответ: ${result[0].answer_uz}`;
            bot.sendMessage(query.message.chat.id, text)
        });
    }
    if (key == 'cab') {
        var arrKeys = [];
        mysqlClient2.query(`SELECT * FROM category_books where key_cat like '${query.data}';`, function (err, result, fields) {
            if (err) throw err;
            mysqlClient2.query(`SELECT * FROM books where category_id=${result[0].id} ORDER BY viewed DESC limit 5`, function (err, result2) {
                if (err) throw err;
                // console.log(result2);
                result2.forEach(function (item) {
                    // console.log(item.name_uz)
                    arrKeys.push(
                        [
                            {
                                text: (globalLang === 'uz') ? item.name : item.name,
                                callback_data: item.book_key
                            }
                        ]
                    )
                });
                arrKeys.push(
                    [
                        {
                            text:(globalLang === 'uz') ? 'Ko`proq kitoblar' : 'Больше книг',
                            url : `http://lib.mf.loc/books/category?id=${result[0].id}`
                        }
                    ]
                );

                if(isEmptyObject(result2)){
                    const tx = (globalLang === 'uz') ? `Kechirasiz xozircha ushbu bo'limda kitoblar mavjud emas` : `Извините, но в этом разделе нет книг`;
                    bot.sendMessage(query.message.chat.id, tx);
                } else {
                    bot.deleteMessage(query.message.chat.id, query.message.message_id);
                    const text = (globalLang === 'uz') ? `${result[0].name} toifasi bo'yicha kitoblar:` : `Книги по категорию ${result[0].name}:`;
                    bot.sendMessage(query.message.chat.id, text, {
                        reply_markup: {
                            inline_keyboard: arrKeys
                        }
                    })
                }
            });
        });
    }
    if (key == 'boo') {
        mysqlClient2.query(`SELECT * FROM books where book_key like '${query.data}';`, function (err, result, fields) {
            if (err) throw err;
            bot.deleteMessage(query.message.chat.id, query.message.message_id);
            const text = (globalLang === 'uz') ? `📕 Kitob: ${result[0].name}\n🖊 Muallif: ${result[0].author}\n🗓 Nashr qilingan yil: ${result[0].year}` : `📕 Книга: ${result[0].name}\n🖊 Автор: ${result[0].author}\n🗓 Дата публикации: ${result[0].year}`;
            arrKeys = ['Ko`chirib olish'];
            // bot.sendMessage(query.message.chat.id, text)
            bot.sendPhoto(query.message.chat.id, `./../backend/web/uploads/images/${result[0].image}`, { caption: text });
            bot.sendDocument(query.message.chat.id, `./../backend/web/uploads/docs/${result[0].document}`)
        });
    }

    // if (key == 'mor') {
    //
    //     bot.deleteMessage(query.message.chat.id, query.message.message_id);
    //     const text = (globalLang === 'uz') ? `📕 Kitob: ${result[0].name}\n🖊 Muallif: ${result[0].author}\n🗓 Nashr qilingan yil: ${result[0].year}` : `📕 Книга: ${result[0].name}\n🖊 Автор: ${result[0].author}\n🗓 Дата публикации: ${result[0].year}`;
    //     arrKeys = ['Ko`chirib olish'];
    //     // bot.sendMessage(query.message.chat.id, text)
    //     bot.sendPhoto(query.message.chat.id, `./../backend/web/uploads/images/${result[0].image}`, { caption: text });
    //     bot.sendDocument(query.message.chat.id, `./../backend/web/uploads/docs/${result[0].document}`)
    //
    // }
})

function isEmptyObject(obj) {
    return !Object.keys(obj).length;
}

bot.onText(/\/start/, msg => {
    const text = `Assalomu aleykum, ${msg.from.first_name + ' ' + msg.from.last_name}
                \nЗдравствуйте, ${msg.from.first_name + ' ' + msg.from.last_name}
                \nIltimos tilni tanlang! | Пожалуйста, выберите язык!`;
    bot.deleteMessage(msg.chat.id, msg.message_id);
    console.log(msg)
    bot.sendMessage(helper.getChatId(msg), text, {
        reply_markup: {
            resize_keyboard: true,
            one_time_keyboard: true,
            keyboard: keyboard.langs
        }
    })
})

