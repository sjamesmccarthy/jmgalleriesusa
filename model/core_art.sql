/* SQL for interactions with ART and COLLECTORS */

-- SELECT ALL ART by Title
-- SELECT A.art_id, A.title, A.`series_num`, A.`edition_num`, A.`edition_num_max`, B.`location` FROM art AS A INNER JOIN art_locations AS B ON B.art_location_id = A.art_location_id 

-- SELECT SPECIFIC ART TITLE FOR EDITION AND SERIES NUMBER
-- SELECT A.art_id, A.title, A.`series_num
-- `, A.`edition_num`, A.`edition_num_max`, B.`location` FROM art AS A INNER JOIN art_locations AS B ON B.art_location_id = A.art_location_id WHERE A.title LIKE
-- ('%Never%') ORDER BY A.`edition_num`DESC

-- TINYVIEWS by Title
-- SELECT A.art_id, A.title, A.frame_material, A.frame_desc, A.`series_num`, A.`edition_num`, A.`edition_num_max`, B.`location`, A.serial_num, A.notes FROM art AS A 
-- INNER JOIN art_locations AS B ON B.art_location_id = A.art_location_id 
-- WHERE A.title LIKE '%serendipity%' 
-- -- AND A.serial_num IS NULL
-- -- AND B.`art_location_id` = 2
-- ORDER BY A.edition_num ASC


-- ART SOLD (INC. DONATED, DAMAGED AND TINYVIEWS) INCLUDING FINANCIALS
-- SELECT A.art_id, A.title, A.`serial_num`, A.`edition_num`, A.`edition_num_max`, ((AC.print) + (AC.frame) + (AC.mat) + (AC.backing) + (AC.packaging) + (AC.shipping) + (AC.ink) + (AC.commission)) AS TOTAL_COSTS, A.value AS SOLD, A.value - (SELECT print + frame + mat + backing + packaging + shipping + ink from art_costs WHERE art_id = A.art_id) AS PL, B.`location`
-- FROM art AS A 
-- INNER JOIN art_locations AS B 
-- ON B.art_location_id = A.art_location_id 
-- INNER JOIN art_costs AS AC ON A.art_id = AC.art_id
-- WHERE A.serial_num IS NOT NULL 


-- ART SOLD WITH SERIAL
-- SELECT A.art_id, A.title, A.`serial_num`, A.`edition_num`, A.`edition_num_max`, B.`location`, C.serial_num, CO.first_name, CO.last_name, CO.company
-- FROM art AS A 
-- INNER JOIN art_locations AS B 
-- ON B.art_location_id = A.art_location_id 
-- INNER JOIN certificate as C
-- ON C.art_id = A.art_id
-- INNER JOIN collector as CO
-- ON CO.collector_id = C.collector_id
-- WHERE A.serial_num IS NOT NULL

-- ART +COSTS
-- SELECT A.*, B.* FROM art AS A INNER JOIN art_costs AS B ON B.art_id = A.art_id

-- ART WITH COSTS + TOTAL by row
-- SELECT A.title, C.print + C.frame + C.mat + C.backing + C.packaging + C.shipping + C.ink + C.commission AS T_COST FROM art_costs C INNER JOIN art AS A ON C.art_id = A.art_id 

-- ART and it's LOCATION, total cost, listed price and PL value
-- SELECT A.art_id, A.title, L.location, A.series_num, A.edition_num, C.print + C.frame + C.mat + C.backing + C.packaging + C.shipping + C.ink + C.commission AS T_COST, A.value AS LISTED, A.value - (C.print + C.frame + C.mat + C.backing + C.packaging + C.shipping + C.ink + C.commission) AS MARGIN FROM art AS A 
-- INNER JOIN art_locations AS L 
-- ON L.art_location_id = A.art_location_id
-- INNER JOIN art_costs as C
-- on C.art_id = A.art_id
-- WHERE A.serial_num IS NULL ORDER BY T_COST DESC
-- AND L.art_location_id = 4

-- ART BY LOCATION, COLLECTOR, DESXCRIPTION WITH COST BREAKDOWN BY TITLE
-- SELECT A.art_id, A.title, L.location, O.first_name, O.last_name, O.company, A.series_num, A.edition_num, A.print_size, A.frame_desc, C.
-- print + C.frame + C.mat + C.backing + C.packaging + C.shipping + C.ink + C.commission
-- AS T_COST, A.value AS LISTED, A.value - (C.print + C.frame + C.mat + C.backing + C.packaging + C.shipping + C.ink + C.commission
-- ) AS MARGIN FROM art AS A 
-- INNER JOIN art_locations AS L 
-- ON L.art_location_id = A.art_location_id
-- INNER JOIN art_costs as C
-- on C.art_id = A.art_id
-- LEFT JOIN certificate as CERT ON CERT.art_id = A.art_id
-- LEFT JOIN collector as O ON CERT.collector_id = O.collector_id
-- WHERE A.title LIKE
-- ('%NEVER%');


-- ART_BY_LOCATION
-- SELECT A.* , B.* FROM art AS A INNER JOIN art_locations AS B ON B.art_location_id = A.art_location_id WHERE A.art_location_id = 2

-- ART BY LOCATION SHOWING, TITLE, VALUE
-- SELECT A.art_id, A.title, A.edition_num, A.edition_num_max, A.print_size, A.frame_size, A.value , B.* FROM art AS A INNER JOIN art_locations AS B ON B.art_location_id = A.art_location_id WHERE A.art_location_id = 4

-- ART BY SPECIFIC LOCATION ID
-- SELECT A.* , B.*, C.* FROM art AS A 
-- INNER JOIN art_locations AS B ON B.art_location_id = A.art_location_id 
-- INNER JOIN art_costs as C ON A.art_id = C.art_id
-- WHERE A.art_location_id = 2

-- TOTAL COSTS SUMMARY TO SOLD ART EXCLUDING DAMAGED & DONATED
-- SELECT 'COSTS/VALUE EXC. DAMAGED, DONATION' AS TITLE, (SUM(AC.print) + SUM(AC.frame) + SUM(AC.mat) + SUM(AC.backing) + sum(AC.packaging) + SUM(AC.shipping) + SUM(AC.ink) + SUM(AC.commission)) AS TOTAL_COSTS, SUM(A.value) AS T_VAL from art_costs AS AC
-- INNER JOIN art AS A ON A.art_id = AC.art_id
-- INNER JOIN certificate AS CERT ON A.art_id = CERT.art_id 
-- WHERE CERT.serial_num = A.serial_num
-- AND A.art_location_id <> 9 
-- OR A.art_location_id <> 8

-- ART PURCHASED BY FIRST NAME
-- SELECT A.title, C.first_name, C.last_name, C.company, A.value, CERT.serial_num, CERT.purchase_date, CERT.certificate_id FROM certificate as CERT
-- INNER JOIN collector as C ON CERT.collector_id = C.collector_id
-- INNER JOIN art as A ON A.art_id = CERT.art_id
-- WHERE C.first_name LIKE 'Nicole' 

-- ART PURCHASED BY TITLE SHOWING COLLECTOR
-- SELECT A.art_id, A.title, L.location, O.first_name, O.last_name, O.company, A.series_num, A.edition_num, A.print_size, A.frame_desc, C.
-- print + C.frame + C.mat + C.backing + C.packaging + C.shipping + C.ink + C.commission
-- AS T_COST, A.value AS LISTED, A.value -(C.print + C.frame + C.mat + C.backing + C.packaging + C.shipping + C.ink + C.commission
-- ) AS MARGIN FROM art AS A 
-- INNER JOIN art_locations AS L 
-- ON L.art_location_id = A.art_location_id
-- INNER JOIN art_costs as C
-- on C.art_id = A.art_id
-- INNER JOIN certificate as CERT ON CERT.art_id = A.art_id
-- INNER JOIN collector as O ON CERT.collector_id = O.collector_id
-- WHERE A.title LIKE
-- ('%NEVER%');
