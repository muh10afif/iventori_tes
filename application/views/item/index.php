<ul class="nav justify-content-center bg-dark text-white">
  <li class="nav-item">
        <a class="nav-link text-white h4" href="<?php echo base_url()?>">Aplikasi Iventori Penjualan</a>
  </li>
</ul>
  <div id="app">
   <div class="container">
    <div class="row">
        <transition
                enter-active-class="animated fadeInLeft"
                     leave-active-class="animated fadeOutRight">
                     <div class="notification is-success text-center px-5 top-middle" v-if="successMSG" @click="successMSG = false">{{successMSG}}</div>
            </transition>
        <div class="col-md-12 mt-2">
            <button class="btn btn-success" @click="addModalItem= true">Tambah Data</button>
            <table class="table is-bordered is-hoverable mt-2">
               <thead class="text-white bg-dark" >
                
                <th class="text-white">No</th>
                <th class="text-white">Nama Item</th>
                <th class="text-white">Unit</th>
                <th class="text-white">Stok</th>
                <th class="text-white">Harga Satuan</th>
                <th class="text-white">Barang</th>
                <th colspan="2" class="text-center text-white">Action</th>
                </thead>
                <tbody class="table-light">
                    <tr v-for="(item, index) in items" class="table-default">
                        <td>{{index + 1}}</td>
                        <td>{{item.nama_item}}</td>
                        <td>{{item.unit}}</td>
                        <td>{{item.stok}}</td>
                        <td>{{item.harga_satuan}}</td>
                        <td>
                        <img :src="imgSrc(item.barang)"  width='50' height="50">
                        </td>
                        <td><button class="btn btn-info fa fa-edit mr-2" @click="editModalItem = true; selectItem(item)"></button><button class="btn btn-danger fa fa-trash" @click="deleteModalItem = true; selectItem(item)"></button></td>
                    </tr>
                    <tr v-if="emptyResult">
                      <td colspan="9" rowspan="4" class="text-center h1">No Record Found</td>
                  </tr>
                </tbody>
                
            </table>
            
        </div>
  
    </div>
     <pagination
        :current_page="currentPage"
        :row_count_page="rowCountPage"
         @page-update="pageUpdateItem"
         :total_users="totalUsers"
         :page_range="pageRange"
         >
      </pagination>
</div>
<?php include 'modal.php';?>

</div>

