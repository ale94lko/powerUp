    <?php $theme = $this->session->userdata('theme_setting');?>
        <footer class="main-footer bg-<?php echo $this->session->userdata('theme_setting');?>">
            <a id="back-to-top" href="#" class="btn btn-<?php echo $theme == 'dark' ? "light" : "dark";?> back-to-top" role="button" aria-label="Scroll to top">
                <i class="fas fa-chevron-up text-<?php echo $theme;?>"></i>
            </a>
            Copyright &copy; 2020 <strong>HNN</strong>.
            Todos los derechos reservados.
        </footer>

