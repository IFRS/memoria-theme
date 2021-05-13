<?php $field_id = uniqid('search-'); ?>
<form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="field has-addons">
        <label class="is-sr-only" for="<?php echo $field_id; ?>">Buscar por:</label>
        <div class="control">
            <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="<?php echo $field_id; ?>" class="input is-small searchform__field" placeholder="Busque uma memória..." required>
        </div>
        <div class="control">
            <button type="submit" class="button is-small is-light searchform__submit" value="Buscar">
                <svg xmlns="http://www.w3.org/2000/svg" class="searchform__icon" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="10" cy="10" r="7" />
                    <line x1="21" y1="21" x2="15" y2="15" />
                </svg>
            </button>
        </div>
    </div>
</form>
