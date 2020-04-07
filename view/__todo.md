
## Thumbnails (consider code reuse and consolidation)
- view_home.php uses component gallery_thumbs to generate thumbnails for all but New Releases
- view_catalog.inc.php uses ssame code but includes specific collections; all; new-releases
- create clas for this inline style [style="padding: 0 10px;"]

## config.json
- Add $this->config->limited_edition_max
- Add $available_sizes 

# core_site.php
- Add MYSQL date DEFINE
