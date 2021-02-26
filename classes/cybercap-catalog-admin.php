<?php

if (!defined('ABSPATH')) {
    die();
}

if (!class_exists('CC_Catalog_Admin')) {

    class CC_Catalog_Admin {

        public function add_menu_page_catalog() {
            add_menu_page(
                'Catalog',
                'Catalog',
                'manage_options',
                'cybercap_catalog',
                function () {
                    $this->render_catalog_page();
                }
            );
        }

        private function render_catalog_page() {
            ?>
            <section>
                <h2>J'aime les patates</h2>
                <p>sérieux ça s'en vient un problème</p>
            </section>
            <?php
        }
    }

}

?>