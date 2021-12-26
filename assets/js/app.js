
Vue.component('modal',{ //modal
    template:`
      <transition
                enter-active-class="animated rollIn"
                     leave-active-class="animated rollOut">
    <div class="modal is-active" >
  <div class="modal-card border border border-secondary">
    <div class="modal-card-head text-center bg-dark">
    <div class="modal-card-title text-white">
          <slot name="head"></slot>
    </div>
<button class="delete" @click="$emit('close')"></button>
    </div>
    <div class="modal-card-body">
         <slot name="body"></slot>
    </div>
    <div class="modal-card-foot" >
      <slot name="foot"></slot>
    </div>
  </div>
</div>
</transition>
    `
})
var v = new Vue({
   el:'#app',
    data:{
        url:'http://localhost/iventori_tes/',
        addModalItem: false,
        addModal: false,
        editModal:false,
        editModalItem:false,
        deleteModal:false,
        deleteModalItem:false,
        users:[],
        items:[],
        file_data: '',
        search: {text: ''},
        emptyResult:false,
        newUser:{
            firstname:'',
            lastname:'',
            gender:'',
            birthday:'',
            email:'',
            contact:'',
            address:''},
        newItem:{
            nama_item:'',
            unit:'',
            stok:'',
            harga_satuan:'',
            barang:''},
        chooseUser:{},
        chooseItem:{},
        formValidate:[],
        successMSG:'',
        
        //pagination
        currentPage: 0,
        rowCountPage:5,
        totalUsers:0,
        pageRange:2
    },
     created(){
    //   this.showAll(); 
      this.showItem(); 
    },
    methods:{
         showAll(){ axios.get(this.url+"user/showAll").then(function(response){
                 if(response.data.users == null){
                     v.noResult()
                    }else{
                        v.getData(response.data.users);
                    }
            })
        },
        showItem(){ axios.get(this.url+"item/show").then(function(response){
                if(response.data.items == null){
                    v.noResult()
                }else{
                    v.getDataItem(response.data.items);
                }
            })
        },
          searchUser(){
            var formData = v.formData(v.search);
              axios.post(this.url+"user/searchUser", formData).then(function(response){
                  if(response.data.users == null){
                      v.noResult()
                    }else{
                      v.getData(response.data.users);
                    
                    }  
            })
        },
          addUser(){   
            var formData = v.formData(v.newUser);
              axios.post(this.url+"user/addUser", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                    v.successMSG = response.data.msg;
                    v.clearAll();
                    v.clearMSG();
                }
               })
        },
          addItem(){   
            // var formData = v.formData(v.newItem);

            this.file_data = $('#barang').prop('files')[0];
            var formData = v.formData(v.newItem);
            formData.append('file', this.file_data);

              axios.post(this.url+"item/addItem", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                    v.successMSG = response.data.msg;
                    v.clearAllItem();
                    v.clearMSG();
                }
               })
        },
        updateUser(){
            var formData = v.formData(v.chooseUser); axios.post(this.url+"user/updateUser", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                      v.successMSG = response.data.success;
                    v.clearAll();
                    v.clearMSG();
                
                }
            })
        },
        updateItem(){

            this.file_data = $('#image_edit').prop('files')[0];
            var formData = v.formData(v.chooseItem);
            formData.append('file', this.file_data);

             axios.post(this.url+"item/updateItem", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                      v.successMSG = response.data.success;
                    v.clearAllItem();
                    v.clearMSG();
                
                }
            })
        },
        deleteUser(){
             var formData = v.formData(v.chooseUser);
              axios.post(this.url+"user/deleteUser", formData).then(function(response){
                if(!response.data.error){
                     v.successMSG = response.data.success;
                    v.clearAll();
                    v.clearMSG();
                }
            })
        },
        deleteItem(){
             var formData = v.formData(v.chooseItem);
              axios.post(this.url+"item/deleteItem", formData).then(function(response){
                if(!response.data.error){
                     v.successMSG = response.data.success;
                    v.clearAllItem();
                    v.clearMSG();
                }
            })
        },
         formData(obj){
			var formData = new FormData();
		      for ( var key in obj ) {
		          formData.append(key, obj[key]);
		      } 
		      return formData;
		},
        getData(users){
            v.emptyResult = false; // become false if has a record
            v.totalUsers = users.length //get total of user
            v.users = users.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination
            
             // if the record is empty, go back a page
            if(v.users.length == 0 && v.currentPage > 0){ 
            v.pageUpdate(v.currentPage - 1)
            v.clearAll();  
            }
        },
        getDataItem(items){
            v.emptyResult = false; // become false if has a record
            v.totalUsers = items.length //get total of user
            v.items = items.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination
            
             // if the record is empty, go back a page
            if(v.items.length == 0 && v.currentPage > 0){ 
            v.pageUpdate(v.currentPage - 1)
            v.clearAll();  
            }
        },
            
        selectUser(user){
            v.chooseUser = user; 
        },
        selectItem(item){
            v.chooseItem = item; 
        },
        clearMSG(){
            setTimeout(function(){
			 v.successMSG=''
			 },3000); // disappearing message success in 2 sec
        },
        clearAll(){
            v.newUser = { 
            firstname:'',
            lastname:'',
            gender:'',
            birthday:'',
            email:'',
            contact:'',
            address:''};
            v.formValidate = false;
            v.addModal= false;
            v.editModal=false;
            v.deleteModal=false;
            v.refresh()
            
        },
        clearAllItem(){
            v.newUser = { 
                nama_item:'',
                unit:'',
                stok:'',
                harga_satuan:'',
                barang:''};
            v.formValidate = false;
            v.addModalItem= false;
            v.editModalItem=false;
            v.deleteModalItem=false;
            v.showItem();
            
        },
        noResult(){
          
               v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
                      v.users = null 
                     v.totalUsers = 0 //remove current page if is empty
            
        },

        pickGender(gender){
           return v.newUser.gender = gender //add new user with selecting gender
        },
        changeGender(gender){
             return v.chooseUser.gender = gender //update gender
        },
        imgGender(value){
            return v.url+'assets/img/gender_'+value+'.png' //for image gender sign in the table
        },
        imgSrc(value){
            return v.url+'assets/upload/'+value //for image gender sign in the table
        },
        pageUpdate(pageNumber){
              v.currentPage = pageNumber; //receive currentPage number came from pagination template
                v.refresh()  
        },
        pageUpdateItem(pageNumber){
              v.currentPage = pageNumber; //receive currentPage number came from pagination template
              v.showItem();
        },
        refresh(){
             v.search.text ? v.searchUser() : v.showAll(); //for preventing
            
        }
    }
})