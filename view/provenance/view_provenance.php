<section class="provenance-section">
    
    <div class="grid-center">
      <div class="col provenance-section--lookup">
        <h2 class="uppercase pb-16 text-center">Digital Provenance Archives</h2>
        <form>
          <input class="half-size--disabled" type="text" class="" placeholder="collector email" id="email" name="email" required />

          <ul class="pb-16 half-size--disabled">
            <li>
            <input type="checkbox" name="include_all" id="include_all" value="1" /> 
            <label for="include_all" class="text-sm">Show all artwork associated with this email</label>
            </li>
          </ul>

          <input class="half-size-disabled" type="text" class="" placeholder="serial or registration number (optional)" id="serial" name="serial" />
          <p class="errorMsg">errMsg</p>
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