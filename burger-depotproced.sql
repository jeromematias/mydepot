/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : burger-depot

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-02-26 18:47:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Procedure structure for `itemtype`
-- ----------------------------
DROP PROCEDURE IF EXISTS `itemtype`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `itemtype`(IN itemid INT(5))
BEGIN
select `type` as stype from tbl_items where id = itemid;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `OrderReciept`
-- ----------------------------
DROP PROCEDURE IF EXISTS `OrderReciept`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `OrderReciept`(IN orderid INT(5))
BEGIN

select tom.quantity, tm.`name`, tm.price, "figure" as `type` from tbl_order_num tom 
left join tbl_purchase_item tp on tom.order_id = tp.order_id 
left join tbl_menu tm on tp.menu_id = tm.menu_id
where tp.order_id = orderid group by tp.menu_id
UNION ALL 
select TotalPrice, CustomerCash, `Change`, purchasedate as `type` from tbl_order_num where order_id = orderid;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `SalesInventory`
-- ----------------------------
DROP PROCEDURE IF EXISTS `SalesInventory`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SalesInventory`(IN SALESDATE VARCHAR(255))
BEGIN
Declare setdate varchar(255);
set setdate = SALESDATE;
if SALESDATE != '' then
select tm.name, IFNULL(sum(ton.quantity), 0) as quantity, IFNULL(sum(ton.quantity) * tm.price, 0) as totalsales, tm.price as price from tbl_menu tm 
left join tbl_order_num ton on tm.menu_id = ton.menu_id  
where ton.purchasedate like setdate
group by tm.menu_id;

else
select tm.name, IFNULL(sum(ton.quantity), 0) as quantity, IFNULL(sum(ton.quantity) * tm.price, 0) as totalsales, tm.price as price from tbl_menu tm 
left join tbl_order_num ton on tm.menu_id = ton.menu_id  
group by tm.menu_id;
end if;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `stockinout`
-- ----------------------------
DROP PROCEDURE IF EXISTS `stockinout`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `stockinout`()
BEGIN

select ti.item_name, ts.quantity, ts.currentstock, ts.datedelivery, tn.`type`, st.`type` as stocktype from tbl_stockinout ts 
left join tbl_items ti on ts.item_id = ti.id
left join stock_type st on ti.`type` = st.id
left join tbl_deliveryname tn on ts.statusid = tn.id
order by datedelivery desc;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `stocklist`
-- ----------------------------
DROP PROCEDURE IF EXISTS `stocklist`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `stocklist`()
BEGIN
select ti.id, ts.quantity, ti.item_name, st.`type`  from tbl_items ti 
left join tbl_stocks ts on ti.id = ts.id
left join stock_type st on ti.`type` = st.id order by ti.id;
END
;;
DELIMITER ;
