<section class="provenance-section">
    
    <div class="grid-center">
      <div class="col provenance-section--lookup">
        <h2 class="uppercase pb-16 text-center">Digital Provenance & Authenticity Tracker</h2>
        <form>
          <input class="half-size-disabled" type="text" class="" placeholder="collector email" id="email" name="email" required />
          <input class="half-size-disabled" type="text" class="" placeholder="serial or registration number" id="serial" name="serial" required />
          <p class="errorMsg">errMsg</p>
          <ul class="pb-16">
            <li>
            <input type="checkbox" name="include_all" id="include_all" value="1" /> 
            <label for="include_all">Show All Artwork For This Collector Email</label>
            </li>
          </ul>
          <button id="lookup-btn">Look Up Artwork</button>
        </form>
      </div>
    </div>

    <div class="grid-center provenance-section--results">
        <div class="col-12 provenance-section--ajax-data">
            <?= $mycollection_html ?>
            <?= $note_html ?>
        </div>
    </div>
</section>