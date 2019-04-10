/* SQL for Photo Iteractions */

-- FIND NUMBER OF VIEWS BY PHOTO & CATEGORY
SELECT V.count AS VIEWS, PH.title from catalog_photo_views as V
RIGHT JOIN catalog_photo AS PH ON V.catalog_photo_id = PH.catalog_photo_id
WHERE PH.catalog_category_id = 1


SELECT DISTINCT P.file_name, P.title, P.catalog_category_id
FROM catalog_photo as P
    RIGHT JOIN catalog_category AS C ON P.catalog_category_id = (SELECT catalog_category_id
    FROM catalog_category
    WHERE path='oceans-lakes-waterfalls')
-- WHERE P.catalog_category_id = (SELECT catalog_category_id FROM catalog_category WHERE path='oceans-lakes-waterfalls')

/* SELECT PHOTO DETAIL DATA AND TITLE OF CATALOG CATEGORY */
SELECT P.*, C.title
from catalog_photo AS P
    INNER JOIN catalog_category AS C ON C.catalog_category_id = (SELECT catalog_category_id
    FROM catalog_photo
    WHERE file_name='bodega-trailhead')
WHERE file_name='bodega-trailhead'
