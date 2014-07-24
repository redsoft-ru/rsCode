## Класс для установки алиасов для элементов и разделов

# Установка

1. Копируем ```rsAliases.php``` в ```/bitrix/php_interface/```
2. Подключаем файл в init.php
```php
CModule::IncludeModule("iblock"); // Для подстраховки
require_once( dirname(__FILE__) . '/rsAliases.php');
```
3. Использование
```php
rsAliases::makeAlias(IBLOCK_ID); // Ставим алиасы для элементов
rsAliases::makeSectionAlias(IBLOCK_ID); // Ставим алиасы для разделов
```