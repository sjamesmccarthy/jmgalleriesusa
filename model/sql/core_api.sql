-- /* SQL for Photo Iteractions */

-- -- FIND NUMBER OF PHOTO VIEWS BY CATEGORY
-- SELECT V.count AS VIEWS, PH.title from catalog_photo_views as V
-- RIGHT JOIN catalog_photo AS PH ON V.catalog_photo_id = PH.catalog_photo_id
-- WHERE PH.catalog_category_id = 4

-- -- FIND NUMBER OF PHOTO VIEWS
-- SELECT V.count AS VIEWS, PH.title
-- from catalog_photo_views as V
--     RIGHT JOIN catalog_photo AS PH ON V.catalog_photo_id = PH.catalog_photo_id

-- -- FIND VIEWS FOR PHOTOS INCLUDING CATEGORY names
-- SELECT V.count AS VIEWS, PH.title, PH.file_name, CATE.title
-- from catalog_photo_views as V
--     RIGHT JOIN catalog_photo AS PH ON V.catalog_photo_id = PH.catalog_photo_id
--     RIGHT JOIN catalog_category AS CATE ON PH.catalog_category_id = CATE.catalog_category_id

-- -- SELECT PHOTO DETAIL DATA AND TITLE OF CATALOG CATEGORY
-- SELECT P.*, C.title
-- from catalog_photo AS P
--     INNER JOIN catalog_category AS C ON C.catalog_category_id = (SELECT catalog_category_id
--     FROM catalog_photo
--     WHERE file_name='bodega-trailhead')
-- WHERE file_name='bodega-trailhead'
