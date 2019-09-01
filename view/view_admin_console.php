<style>

.toolbox:not(:last-child) {
        border-bottom: 1px solid #CCC;
        margin-bottom: 10px;
        position: relative;
    }

.nav{
        margin-right: 80px; 
        background-color: rgba(0,0,0,.1); 
        padding: 30px !important;
        min-height: 50vh;
        border-radius: 4px;
    }

div ul li {
        margin-bottom: 10px;
        font-weight: 300;
        font-size: .9rem;
    }

.summary {
    margin-top: 32px;
}

.stat {
    font-size: 5rem;
}

</style>

<section style="min-height: 100vh;">
    <div class="grid-8-center">
        <div class="nav col-2">
            
            <div class="toolbox" style="padding-bottom: 10px;">
                <div style="display: inline-block;"><img style="width: 40px;" src="/view/image/profile_img.jpg" /></div>
                <div style="display: inline-block; padding-left: 10px; position: absolute; top: 5px;">James McCarthy<br />Photographer</div>
            </div>

            <div class="toolbox">
                <ul>
                <li>Portfolio Catalog Index</li>
                <li>Add a Photot To Portfolio Index</li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li>Inventory Index</li>
                <li>Add a Photo To Inventory</li>
                <li>r/Art, Costs, PL (everything)</li>
                <li>r/Lookup Number & Edition</li>
                <li>r/Lookup By Location</li>
                <li>r/Damaged and Donated Summary</li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li>Collector Index</li>
                <li>Add a Collector</li>
                <li>Create Certificate of Authenticity</li>
                <li>r/Find Collector By Name</li>
                <li>r/Find Collectors By Photograph</li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li><a href="/admin">Logout</a></li>
                </ul>
            </div>

        </div>

        <div class="col-6">
            <h2><?= date("F j, Y"); ?></h2>
            <!-- <p class="small">This is your admin console where you will be able to add new photos, collectors and track inventory.</p> -->

            <div class="grid-2 summary">
                <div class="col"><p class="stat">42</p><p>Photos in your online catalog</p></div>
                <div class="col"><p class="stat">125</p><p>Photos in your total inventory</p></div>
            </div>

        </div>

    </div>
</section>