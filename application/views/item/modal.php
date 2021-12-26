<!--add modal-->
<modal v-if="addModalItem" @close="clearAllItem()">

<h3 slot="head" >Tambah Item</h3>
<div slot="body" class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Nama Item</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nama_item}" name="nama_item" v-model="newItem.nama_item">
            
             <div class="has-text-danger" v-html="formValidate.nama_item"> </div>
        </div>
        
         <div class="form-group"> 
            <label>Unit</label>
            <select name="unit" class="form-control" :class="{'is-invalid': formValidate.unit}" v-model="newItem.unit">
                <option value="kg">KG</option>
                <option value="pcs">PCS</option>
            </select>
            
            <div class="has-text-danger" v-html="formValidate.unit"> </div>
        </div>

         <div class="form-group"> 
            <label>Stok</label>
            <input type="number" class="form-control" :class="{'is-invalid': formValidate.stok}" name="stok" v-model="newItem.stok">
            
             <div class="has-text-danger" v-html="formValidate.stok"> </div>
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label>Harga Satuan</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.harga_satuan}" name="harga_satuan" v-model="newItem.harga_satuan">
            
             <div class="has-text-danger" v-html="formValidate.harga_satuan"> </div>
        </div>

        <div class="form-group">
            <label>Barang</label>
            <input type="file" class="form-control" name="barang" id="barang">
            
        </div>
    
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="addItem">Add</button>
</div>

</modal>



<!--update modal-->

<modal v-if="editModalItem" @close="clearAllItem()">
<h3 slot="head" >Edit User</h3>
<div slot="body" class="row">
<div class="col-md-6">
        <div class="form-group">
            <label>Nama Item</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nama_item}" name="nama_item" v-model="chooseItem.nama_item">
            
             <div class="has-text-danger" v-html="formValidate.nama_item"> </div>
        </div>
        
         <div class="form-group"> 
            <label>Unit</label>
            <select name="unit" class="form-control" :class="{'is-invalid': formValidate.unit}" v-model="chooseItem.unit">
                <option value="kg">KG</option>
                <option value="pcs">PCS</option>
            </select>
            
            <div class="has-text-danger" v-html="formValidate.unit"> </div>
        </div>

         <div class="form-group"> 
            <label>Stok</label>
            <input type="number" class="form-control" :class="{'is-invalid': formValidate.stok}" name="stok" v-model="chooseItem.stok">
            
             <div class="has-text-danger" v-html="formValidate.stok"> </div>
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label>Harga Satuan</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.harga_satuan}" name="harga_satuan" v-model="chooseItem.harga_satuan">
            
             <div class="has-text-danger" v-html="formValidate.harga_satuan"> </div>
        </div>

        <div class="form-group">
            <label>Barang</label>
            <input type="file" class="form-control" name="barang" id="image_edit">
            
        </div>
    
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="updateItem">Update</button>
</div>
</modal>


<!--delete modal-->
<modal v-if="deleteModalItem" @close="clearAllItem()">
    <h3 slot="head">Delete</h3>
    <div slot="body" class="text-center">Do you want to delete this record?</div>
    <div slot="foot">
        <button class="btn btn-dark" @click="deleteModalItem = false; deleteItem()" >Delete</button>
        <button class="btn" @click="deleteModalItem = false">Cancel</button>
    </div>
</modal>