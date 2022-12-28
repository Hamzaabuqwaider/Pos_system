API Documentation

Response Schema: JSON OBJECT {"success": Boolean, "message_code": String, "body": Array}

GET /api/items

- Fetches all items from the DB.
- Request arguments: none
- 404 - No item was found

GET /api/item

- Fetch item by selected from database
- Request arguments: {item_id:integer}
- 404 - No item was found

POST /api/transaction/create

- Create transaction in the table transacaions in database
- Request arguments: {item_id:integer,quantity:integer,total:integer,user_id:integer}
- 422 - if quantity param was not provided
- 423 - if item_id param was not provided
- 424 - if total param was not provided
- 421 - if transaction was not created

GET /api/transaction

- Fetches all transactions from the DB.
- Request arguments: none
- 404 - No transaction was found

DELETE /api/transaction/delete

Request arguments: {"id": integer,item_id: integer,quantity:integer}

- 422 - if id param was not provided
- 423 - if item_id param was not provided
- 424 - if quantity param was not provided
- 404 - if item was not found
