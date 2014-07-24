# Класс для установки алиасов для элементов и разделов

## Установка
- Если сайт в кодировке cp1251, перекодируем файл в эту кодировку
- Копируем ```rsAliases.php``` в ```/bitrix/php_interface/```
- Подключаем файл в init.php
```php
CModule::IncludeModule("iblock"); // Для подстраховки
require_once( dirname(__FILE__) . '/rsAliases.php');
```
## Использование
```php
rsAliases::makeAlias(IBLOCK_ID); // Ставим алиасы для элементов
rsAliases::makeSectionAlias(IBLOCK_ID); // Ставим алиасы для разделов
rsAliases::cleanAliases(IBLOCK_ID); // Очистка алиасов элементов
rsAliases::cleanSectionAliases(IBLOCK_ID); // Очистка алиасов раздела
```
## Тестировалось
Bitrix v10-14
## Авторы
- Mitrich
- Skvor