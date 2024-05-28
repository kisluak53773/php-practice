#Select SQL
SELECT * FROM customers - выборка всех элементов

SELECT contact_name, city FROM customers - выбрать только города и контактные имена и таблицы customers

SELECT order_id, shiped_date - order_date FROM orders - выбрать все записи и из них взять order_id и разницу между датой отправки и датой формирования заказа

SELECT DISTINCT city FROM customers - выбрать все уникальные города из таблицы customers

SELECT DISTINCT city, country FROM customers - уникальные сочетания городов из таблицы customers

SELECT COUNT(*) FROM customers - считает кол-во заказчиков

SELECT COUNT(DISTINCT country) FROM customers - кол-во уникальных стран заказчиков

SELECT * FROM orders WHERE ship_country IN ('France', 'Austria', 'Spain') - выбор всех стран где страна доставки Франция, Австрия, Испания

SELECT * FROM orders ORDER BY required_date DESC, shipped_date - выбрать все страны и отсортировать по required_date по убыванию, а по дате отправки по возрастнаию

SELECT MIN(unit_price) FROM products WHERE units_in_stock > 30 - минимальная цена продукта, где количество товаров в запасе не меньше 30

SELECT MAX(unit_price) FROM products WHERE units_in_stock > 30 -  максимальная цена товара, едениц которого в запасе не меньще 30

SELECT AVG(shipped_date-order_date) FROM orders WHERE ship_country='USA' - среднее время доставки в страны США с моментва формирования заказа

SELECT SUM(units_in_stock*unit_price) FROM products WHERE discontinued=0 - посчитать на какую сумму товаров в запасе, которые предпологается продолжать продовать

SELECT * FROM orders WHERE ship_country LIKE 'U%' - выберет все страны где первая буква в названии это U

SELECT order_id, customer_id, freight, ship_country FROM orders WHERE ship_country LIKE 'N%' ORDER BY freight DESC - вывести до 10 заказов указанные поля, для стран, которые начинаются на N и отсортированны по весу по убываню

SELECT first_name, last_name, home_phone, region FROM employees WHERE region IS NOT NULL - работники, у которых известен регион

SELECT COUNT(*) FROM customers WHERE region IS NOT NULL -  кол-во заказчиков с известным регионом

SELECT ship_country, COUNT(*) FROM orders GROUP BY ship_country ORDER BY COUNT(*) DESC - посчитать кол-во стран для отправки и вывести их по убыванию

SELECT ship_country, SUM(freight) FROM orders WHERE ship_region IS NOT NULL GROUP BY ship_country HAVING SUM(freight) > 2750 ORDER BY SUM(freight) DESC - сумма товаров по странам с извесным регионом,где сумма товаров больше 2750 отсортированная по убыванию

SELECT country FROM customers UNION SELECT country FROM  suppliers ORDER BY country - сначала выбирает все странны из заказчиков, потом и з поставщиков, а затем сортирует их по возростанию

SELECT country FROM customers INTERSECT SELECT country FROM suppliers INTERSECT SELECT country FROM employees - возвращает страны, по которым одновременно пересекаются и заказчики, и поставщики и работники

SELECT country FROM customers INTERSECT SELECT country FROM suppliers EXCEPT SELECT country FROM employees - выбрать страны, по которым пересекаются поставщики и заказчики, но нету работников


#Join sql

SELECT c.company_name as customer, CONCAT(e.first_name, ' ', e.last_name) AS employee 
FROM orders as o 
JOIN customers as c USING(customer_id) 
JOIN employees as e USING(employee_id) 
JOIN shippers as s ON o.ship_via = s.shipper_id 
WHERE c.city = 'London'
 AND e.city = 'London'
 AND s.company_name = 'Speedy Express' - Находит заказчиков и обслуживающих их заказы сотрудников таких, что и заказчики и сотрудники из города London, а доставка идёт компанией Speedy Express. Вывести компанию заказчика и ФИО сотрудника.

SELECT p.product_name, p.units_in_stock, s.company_name, s.phone
FROM products as p 
JOIN categories as c USING(category_id)
JOIN suppliers as s USING(supplier_id)
WHERE p.discontinued =0
AND c.category_name IN ('Beverages','Seafood')
AND p.units_in_stock < 20 - Найти активные (см. поле discontinued) продукты из категории Beverages и Seafood, которых в продаже менее 20 единиц. Вывести наименование продуктов, кол-во единиц в продаже, имя контакта поставщика и его телефонный номер.

SELECT distinct contact_name, order_id
FROM customers
LEFT JOIN orders USING(customer_id)
WHERE order_id IS NULL
ORDER BY contact_name - выбирает заказчиков не сделавщих ни одного заказа, за счет того, что мы используем LEFT JOIN, запрос не отваливается, даже если заказы отсутствуют 

SELECT distinct c.contact_name, c.order_id
FROM orders as o
RIGHT JOIN customers as c USING(customer_id)
WHERE o.order_id IS NULL
ORDER BY c.contact_name - находит заказчиков, которые не сделали заказ

SELECT contact_name, order_id
FROM orders
RIGHT JOIN customers USING(customer_id)
WHERE order_id IS NULL
ORDER BY contact_name LIMIT 100 - так же находит клиентов, которые не сделали заказ, но через RIGHT JOIN

#Subquerries sql


SELECT product_name, units_in_stock
FROM products
WHERE discontinued = 0
AND units_in_stock < ALL(SELECT AVG(quantity)
	   FROM order_details
	   GROUP BY product_id)
ORDER BY units_in_stock DESC - Выводим товары, которые еще в продаже, и у которых количество товаров в запасе меньшн, чем в среднем в деталях заказа

SELECT o.customer_id, SUM(o.freight) AS freight_sum 
  FROM orders AS o
       INNER JOIN (SELECT customer_id, AVG(freight) AS freight_avg
                     FROM orders
                    GROUP BY customer_id) AS oa
       ON oa.customer_id = o.customer_id
 WHERE o.freight > oa.freight_avg
   AND o.shipped_date BETWEEN '1996-07-16' AND '1996-07-31'
 GROUP BY o.customer_id
 ORDER BY freight_sum - запрос, который выводит общую сумму фрахтов заказов для компаний-заказчиков для заказов, стоимость фрахта которых больше или равна средней величине стоимости фрахта всех заказов, а также дата отгрузки заказа должна находится во второй половине июля 1996 года. Результирующая таблица должна иметь колонки customer_id и freight_sum

SELECT customer_id, ship_country, order_price
  FROM orders
       JOIN (SELECT order_id,
                          SUM(unit_price * quantity - unit_price * quantity * discount) AS order_price
                     FROM order_details
                    GROUP BY order_id) od
       USING(order_id)
 WHERE ship_country IN ('Argentina' , 'Bolivia', 'Brazil', 'Chile', 'Colombia', 'Ecuador', 'Guyana', 'Paraguay', 
						'Peru', 'Suriname', 'Uruguay', 'Venezuela')
   AND order_date >= '1997-09-01'
 ORDER BY order_price DESC
 LIMIT 3 - запрос, который выводит 3 заказа с наибольшей стоимостью, которые были созданы после 1 сентября 1997 года включительно и были доставлены в страны Южной Америки.

SELECT product_name
FROM products
WHERE product_id = ANY (SELECT product_id FROM order_details WHERE quantity = 10) - возвращает продукты, у которых количество в заказе равно 10


