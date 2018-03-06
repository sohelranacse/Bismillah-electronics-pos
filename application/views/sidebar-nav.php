<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            
            <li><a href="<?php echo base_url(); ?>home/index"><i class="icofont icofont-home"></i> Dashboard</a></li>
            <?php 
                /*$userRole = $this->session->userdata('role');
                if ($userRole==1) {
                    echo '<li><a href="'.base_url().'home/menu"><strong><i class="icofont icofont-sub-listing"></i></strong> Menu</a></li>';
                }else{
                    echo '';
                }*/
            ?>
            <?php
            $userId = $this->session->userdata('id');
            if ($userId==1) {

                $this->db->select("*");
                $admin_menus=$this->db->get("menu");
                foreach ($admin_menus->result_array() as $admin_menu_info) {
                    $admin_menu_id = $admin_menu_info['id'];
                    $admin_menu = $admin_menu_info['menu'];
                    $admin_icon = $admin_menu_info['icon'];

                    if (!$admin_menu==0) {
                        
                        echo '<li><a href="#"><i class="icofont icofont-'.$admin_icon.' fa-fw"></i> '.$admin_menu.' <span class="fa arrow"></span></a>';

                        $this->db->select("*");
                        $this->db->where('menuid',$admin_menu_id);
                        $admin_sub_menu=$this->db->get("menu");
                        echo '
                                <ul class="nav nav-second-level">
                        ';

                            foreach ($admin_sub_menu->result_array() as $admin_sub_menu_info) {
                                $admin_submenu = $admin_sub_menu_info['submenu'];
                                $admin_sub_link = $admin_sub_menu_info['sub_link'];

                                echo '<li><a href="'.base_url().'home/'.$admin_sub_link.'"><i class="fa fa-caret-right"></i> '.$admin_submenu.'</a></li>';

                            }
                        echo '
                                </ul>

                            </li>
                        ';
                    }
                }
            }else{

                $this->db->select("*");
                $this->db->where("userId",$userId);
                $this->db->group_by("menuid");
                $role_info=$this->db->get("role");
                foreach ($role_info->result_array() as $getrole_info) {
                    $role_menuid = $getrole_info['menuid'];



                    $this->db->select("*");
                    $this->db->where("id",$role_menuid);
                    $menu_info1=$this->db->get("menu");
                    foreach ($menu_info1->result_array() as $get_menu_info1) {
                        $menu = $get_menu_info1['menu'];
                        $icon = $get_menu_info1['icon'];
                        $id = $get_menu_info1['id'];
                        echo '<li><a href="#"><i class="icofont icofont-'.$icon.' fa-fw"></i> '.$menu.' <span class="fa arrow"></span></a>';


                        $this->db->select("*");
                        $this->db->where("userId",$userId);
                        $role_infoo=$this->db->get("role");
                        echo '
                            <ul class="nav nav-second-level">
                        ';
                        foreach ($role_infoo->result_array() as $getrole_infoo) {
                            $role_submenuid = $getrole_infoo['submenuid'];

                            $this->db->select("*");
                            $this->db->where("menuid",$id);
                            $menu_info2=$this->db->get("menu");
                            
                            foreach ($menu_info2->result_array() as $get_menu_info2) {
                                $submenu_id = $get_menu_info2['id'];
                                $submenu = $get_menu_info2['submenu'];
                                $sub_link = $get_menu_info2['sub_link'];

                                if ($role_submenuid == $submenu_id) {
                                    echo '<li><a href="'.base_url().'home/'.$sub_link.'"><i class="fa fa-caret-right"></i> '.$submenu.'</a></li>';
                                }                               
                            }
                        }
                        echo '
                                </ul>

                            </li>
                        ';
                    }
                }

            }
            ?>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
