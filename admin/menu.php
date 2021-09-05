
      <!--menu -->
      
      <?php if($_SESSION['level']=="Admin"){?>
      <li <?php if($page == "Dashboard") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>
        <a class="nav-link" href="index-admin.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>
      <?php }
      else{?>
            <li <?php if($page == "Dashboard") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>
        <a class="nav-link" href="index-petugas.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>
      <?php }?>
      

      <li <?php if($page == "pesan") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>        
      <a class="nav-link collapsed" href="pesan-pengaduan.php">
          <i class="far fa-fw fa-comment"></i>
          <span>Pesan Pengaduan Baru</span>
        </a>
      </li>

      <li <?php if($page == "pengaduan") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>     
              <a class="nav-link collapsed" href="daftar-pengaduan.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Daftar Semua Pengaduan</span>
        </a>
      </li>
      
      <li <?php if($page == "masyarakat") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>     
              <a class="nav-link collapsed" href="daftar-masyarakat.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Daftar Masyarakat</span>
        </a>
      </li>  

      <?php if($_SESSION['level']=="Admin"){?>
      <li <?php if($page == "petugas") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>     
              <a class="nav-link collapsed" href="daftar-petugas.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Daftar Petugas</span>
        </a>
      </li>
      <?php } ?>
      
      <?php if($_SESSION['level']=="Petugas"){?>
      <li <?php if($page == "Ubah") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>     
              <a class="nav-link collapsed" href="ubah-akun.php">
          <i class="far fa-fw fa-user"></i>
          <span>Ubah Akun</span>
        </a>
      </li>
      <?php } ?>
