#Homework Report
by Hasan Dweik
to Ontex Digital Factory
hasan_dweik@outlook.com

Ex:1:
 
Connected using putty to the remote server with the IP address 217.69.11.235 and credentials given by email.
1.1









uname -a: This command provides information about the system, including the Linux kernel version and the hostname. The information returned by this command may also give you some hints about the Linux distribution installed on the system.

lsb_release: This command is available on most modern Linux distributions and provides information about the distribution release.

1.2
 
•	drwxr-sr--: This is the permission string for the folder.
•	d: Indicates that this is a directory (folder)
•	rwx: The owner (root) has read, write, and execute permissions for this folder.
•	r-s: Members of the group (candidate) have read and execute permissions, but not write permissions.
•	r--: Other users have only read permissions, but not write or execute permissions.
•	Uid: This is the user ID (UID) of the owner of the folder, which is 0 (root).
•	Gid: This is the group ID (GID) of the group associated with the folder, which is 1002 (candidate).
•	These permissions indicate that the owner of the folder (root) has full control over it, members of the group (candidate) can read and execute its contents, but not modify it, and other users can only read its contents but cannot make any changes.
1.3
 
This command will search for a file named "api_key" starting from the root directory (/) and it will redirect errors (2>/dev/null) to avoid showing any "permission denied" messages.
Unfortunately, I couldn’t find the file, I think there is a trick for that. If I have time I will follow it later.

Ex2:
 
 
 
	  
 
2.1
•	A customer entity can be associated with a store using the store_id
•	Each sales order is associated with a customer and a store using the customer
2.2

SELECT customer_entity.email, sales_order.grand_total, sales_order.created_at
FROM sales_order
INNER JOIN customer_entity ON sales_order.customer_id = customer_entity.entity_id
INNER JOIN store ON sales_order.store_id = store.store_id
WHERE store.name = 'LBC FR-FR' AND sales_order.status = 'processing' AND customer_entity.created_at >= '2022-12-01' AND customer_entity.created_at < '2023-01-01'
AND customer_entity.email LIKE 'odevelop%'
 
2.3
SELECT customer_entity.created_at AS customer_created_at, customer_entity.entity_id, customer_entity.email, 
       DATE_FORMAT(sales_order.created_at, '%Y-%m') AS order_month, 
       COUNT(sales_order.entity_id) AS order_count, 
       SUM(sales_order.grand_total) AS order_total
FROM customer_entity
INNER JOIN sales_order ON customer_entity.entity_id = sales_order.customer_id
INNER JOIN store ON sales_order.store_id = store.store_id
WHERE store.store_id = 4 AND sales_order.status IN ('complete', 'processing', 'closed')
GROUP BY customer_created_at, customer_entity.entity_id, customer_entity.email, order_month



