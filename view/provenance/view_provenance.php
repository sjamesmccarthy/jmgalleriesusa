<section class="provenance-section">
    
    <div class="grid-center">
      <div class="col provenance-section--lookup">
        <h2 class="uppercase pb-16 text-center">Digital Provenance & Authenticity Tracker</h2>
        <form>
          <input class="half-size--disabled" type="text" class="" placeholder="collector email" id="email" name="email" required />
          <ul class="pb-16 half-size--disabled">
            <li>
            <input type="checkbox" name="include_all" id="include_all" value="1" /> 
            <label for="include_all">Show All Artwork Registered/Licensed With This Collector Email</label>
            </li>
          </ul>

          <input class="half-size-disabled" type="text" class="" placeholder="serial or registration number (optional)" id="serial" name="serial" required />
          <p class="errorMsg">errMsg</p>
          <button id="lookup-btn">Look Up Artwork</button>
        </form>

        <p class="text-small pt-16">Copyright <?= $this->config->copyright ?></p>
      </div>
    </div>

    <div class="grid-center provenance-section--results">
        <div class="col-12 provenance-section--ajax-data">
            <?= $mycollection_html ?>
            <?= $note_html ?>
        </div>
    </div>
</section>