<?php $field_id = uniqid('search-'); ?>
<form role="search" method="get" class="form-inline searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="sr-only" for="<?php echo $field_id; ?>">Buscar por:</label>
    <div class="input-group">
        <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="<?php echo $field_id; ?>" class="form-control form-control-sm border-secondary searchform__field" placeholder="Busque uma memória..." required>
        <span class="input-group-append">
            <button type="submit" class="btn btn-secondary btn-sm searchform__submit" title="Buscar" value="Buscar">
                <svg xmlns="http://www.w3.org/2000/svg" class="searchform__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="10" cy="10" r="7" />
                    <line x1="21" y1="21" x2="15" y2="15" />
                </svg>
            </button>
        </span>
    </div>
</form>