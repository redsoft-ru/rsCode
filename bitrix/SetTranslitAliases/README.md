# Класс для установки алиасов для элементов и разделов

## Установка

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
```