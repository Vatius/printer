# printer

в папке panel находится "Интерфейс менеджера"

в папке server находится PHP приложение API

для установки panel:
- изменить файл http-common.js (заменить адрес сервера на свой)
- npm i
- npm run build

для установки php приложения:
- composer install
- нстроить доступ к бд (файл server/config/db.php)
- выполнить миграции (yii migrate) или импорировать в бд дамп (printer.sql)
- настроить хост (корень server/web)


##Формат запроса (для заказа):

###POST /order

{
	"fio": "Василий",
	"article": "canon",
	"sum": "1000",
	"tel": "8(912)1333223",
}