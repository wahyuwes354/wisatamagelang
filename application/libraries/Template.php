<?php

/**
 *
 */
class Template
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    function views($template = null, $data = null)
    {
        if ($template != NULL) {
            // head
            $data['_meta']              = $this->_ci->load->view('Bo/_layout/_meta', $data, true);
            $data['_css']               = $this->_ci->load->view('Bo/_layout/_css', $data, TRUE);

            // Header
            $data['_navbar']            = $this->_ci->load->view('Bo/_layout/_navbar', $data, TRUE);
            // $data['_header'] 		= $this->_ci->load->view('Bo/_layout/_header', $data, TRUE);

            //Sidebar
            $data['_sidebar']           = $this->_ci->load->view('Bo/_layout/_sidebar', $data, TRUE);

            //Content
            $data['_headerContent']     = $this->_ci->load->view('Bo/_layout/_headerContent', $data, TRUE);
            $data['_mainContent']       = $this->_ci->load->view($template, $data, TRUE);
            $data['_content']           = $this->_ci->load->view('Bo/_layout/_content', $data, TRUE);

            //Footer
            $data['_footer']            = $this->_ci->load->view('Bo/_layout/_footer', $data, TRUE);

            //JS
            $data['_js']                = $this->_ci->load->view('Bo/_layout/_js', $data, TRUE);

            echo $data['_template']     = $this->_ci->load->view('Bo/_layout/_template', $data, TRUE);
        }
    }
}
