/* SQL for Photo Iteractions */

-- FIND NUMBER OF VIEWS BY PHOTO & CATEGORY
SELECT V.count AS VIEWS, PH.title from catalog_photo_views as V
RIGHT JOIN catalog_photo AS PH ON V.catalog_photo_id = PH.catalog_photo_id
WHERE PH.catalog_category_id = 1

SELECT title, file_name from catalog_photo WHERE catalog_category_id = 2

