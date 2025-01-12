
<!-- Fetch sizes -->

select si.size, s.stock_quantity, c.color
from product_stock as s
inner join product_sizes as si
on s.size_ID = si.size_ID
inner join product_colors as c
on s.color_ID = c.color_ID
where s.product_ID = 31 and c.color = 'white' and si.size = 'S' and s.stock_quantity > 0


<!-- Fetch stock quantity -->

SELECT stock_quantity
FROM product_stock
WHERE product_ID = 31
AND size_ID = (SELECT size_ID FROM product_sizes WHERE size = 'M')
AND color_ID = (SELECT color_ID FROM product_colors WHERE color = 'black');
