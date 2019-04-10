/* SQL for Photo Iteractions */

-- FIND NUMBER OF VIEWS BY PHOTO & CATEGORY
SELECT V.count AS VIEWS, PH.title from catalog_photo_views as V
RIGHT JOIN catalog_photo AS PH ON V.catalog_photo_id = PH.catalog_photo_id
WHERE PH.catalog_category_id = 1

SELECT title, file_name from catalog_photo WHERE catalog_category_id = 2

/* SELECT catalog_category_id FROM catalog_category WHERE path='oceans-lakes-waterfalls' */

SELECT DISTINCT P.file_name, P.title, P.catalog_category_id
FROM catalog_photo as P
    RIGHT JOIN catalog_category AS C ON P.catalog_category_id = (SELECT catalog_category_id
    FROM catalog_category
    WHERE path='oceans-lakes-waterfalls')
-- WHERE P.catalog_category_id = (SELECT catalog_category_id FROM catalog_category WHERE path='oceans-lakes-waterfalls')

-- SELECT P.catalog_photo_id, P.catalog_category_id, P.title, P.file_name FROM catalog_photo AS P where catalog_category_id=1