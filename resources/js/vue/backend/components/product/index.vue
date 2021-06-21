<template>
    <span>
        <head-top/>
        <side-bar/>
        <div class="page-wrapper">
            <div class="container-fluid">
                <el-dialog title="Thêm sản phẩm" :visible.sync="addProductForm">
                    <el-form :model="form">
                        <el-form-item label="Tên sản phẩm" :label-width="formLabelWidth">
                            <el-input v-model="form.name" autocomplete="off"></el-input>
                        </el-form-item>
                        <div class="row">
                            <div class="col-lg-6">
                                <el-form-item label="Nhãn hiệu" :label-width="formLabelWidth">
                                    <el-select v-model="form.brand_id" placeholder="Chọn nhãn hiệu">
                                        <!-- <el-option  label="Danh mục cha" value="0"></el-option> -->
                                        <el-option  v-for="item in brands" :key="item.id" :label="item.name" :value="item.id"></el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-lg-6">
                                <el-form-item label="Danh mục" :label-width="formLabelWidth">
                                    <el-select v-model="form.category_id" placeholder="Chọn danh mục">
                                        <!-- <el-option  label="Danh mục cha" value="0"></el-option> -->
                                        <el-option  v-for="item in categories" :key="item.id" :label="item.name" :value="item.id"></el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-lg-6">
                                <el-form-item label="Màu sắc" :label-width="formLabelWidth">
                                    <el-select v-model="form.color_id" multiple collapse-tags placeholder="Màu sắc">
                                        <el-option
                                        v-for="item in colors"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                        <span style="float: left">{{ item.name }}</span>
                                        <span :style="'float: right; width:20px;height:20px;background:'+ item.color_code"></span>
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-lg-6">
                                <el-form-item label="Kích cỡ" :label-width="formLabelWidth">
                                    <el-select
                                        v-model="form.size_id"
                                        multiple
                                        collapse-tags
                                        style="margin-left: 20px;"
                                        placeholder="Chọn kích cỡ">
                                        <el-option
                                        @click="abc(item.id)"
                                        v-for="item in sizes"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                        </div>
                        <el-form-item label="Giá sản phẩm" :label-width="formLabelWidth">
                            <el-input v-model="form.price" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Giá khuyến mãi" :label-width="formLabelWidth">
                            <el-input v-model="form.sale_price" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Tóm tắt" :label-width="formLabelWidth">
                            <el-input v-model="form.slug" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Chi tiết sản phẩm" :label-width="formLabelWidth">
                            <el-input v-model="form.description" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Ảnh sản phẩm" :label-width="formLabelWidth">
                            <el-input v-model="form.image" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Ảnh chi tiết" :label-width="formLabelWidth">
                            <el-input v-model="form.imageDetail" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Trạng thái" :label-width="formLabelWidth">
                            <el-tooltip content="Ẩn/Hiện" placement="top">
                                <el-switch
                                    v-model="form.status"
                                    active-value="1"
                                    inactive-value="0">
                                </el-switch>
                            </el-tooltip>
                        </el-form-item>
                    </el-form>
                    <span slot="footer" class="dialog-footer">
                        <el-button @click="addProductForm = false">Cancel</el-button>
                        <el-button type="primary" @click="addItem()">Confirm</el-button>
                    </span>
                </el-dialog>
                <el-dialog title="Chỉnh sửa sản phẩm" :visible.sync="editProductForm">
                    <el-form :model="editForm">
                        <el-form-item label="Tên sản phẩm" :label-width="formLabelWidth">
                            <el-input v-model="editForm.name" autocomplete="off"></el-input>
                        </el-form-item>
                        <div class="row">
                            <div class="col-lg-6">
                                <el-form-item label="Nhãn hiệu" :label-width="formLabelWidth">
                                    <el-select v-model="editForm.brand_id" placeholder="Chọn nhãn hiệu">
                                        <!-- <el-option  label="Danh mục cha" value="0"></el-option> -->
                                        <el-option  v-for="item in brands" :key="item.id" :label="item.name" :value="item.id"></el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-lg-6">
                                <el-form-item label="Danh mục" :label-width="formLabelWidth">
                                    <el-select v-model="editForm.category_id" placeholder="Chọn danh mục">
                                        <!-- <el-option  label="Danh mục cha" value="0"></el-option> -->
                                        <el-option  v-for="item in categories" :key="item.id" :label="item.name" :value="item.id"></el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-lg-6">
                                <el-form-item label="Màu sắc" :label-width="formLabelWidth">
                                    <el-select v-model="editForm.color_id" multiple collapse-tags placeholder="Màu sắc">
                                        <el-option
                                        v-for="item in colors"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                        <span style="float: left">{{ item.name }}</span>
                                        <span :style="'float: right; width:20px;height:20px;background:'+ item.color_code"></span>
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-lg-6">
                                <el-form-item label="Kích cỡ" :label-width="formLabelWidth">
                                    <el-select
                                        v-model="editForm.size_id"
                                        multiple
                                        collapse-tags
                                        style="margin-left: 20px;"
                                        placeholder="Chọn kích cỡ">
                                        <el-option
                                        @click="abc(item.id)"
                                        v-for="item in sizes"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                        </div>
                        <el-form-item label="Giá sản phẩm" :label-width="formLabelWidth">
                            <el-input v-model="editForm.price" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Giá khuyến mãi" :label-width="formLabelWidth">
                            <el-input v-model="editForm.sale_price" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Tóm tắt" :label-width="formLabelWidth">
                            <el-input v-model="editForm.slug" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Chi tiết sản phẩm" :label-width="formLabelWidth">
                            <el-input v-model="editForm.description" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Ảnh sản phẩm" :label-width="formLabelWidth">
                            <el-input v-model="editForm.image" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Ảnh chi tiết" :label-width="formLabelWidth">
                            <el-input v-model="editForm.imageDetail" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Trạng thái" :label-width="formLabelWidth">
                            <el-tooltip content="Ẩn/Hiện" placement="top">
                                <el-switch
                                    v-model="editForm.status"
                                    active-value="1"
                                    inactive-value="0">
                                </el-switch>
                            </el-tooltip>
                        </el-form-item>
                    </el-form>
                    <span slot="footer" class="dialog-footer">
                        <el-button @click="editProductForm = false">Cancel</el-button>
                        <el-button type="primary" @click="editItem(editForm.id)">Confirm</el-button>
                    </span>
                </el-dialog>
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Sản phẩm</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Sản phẩm</li>
                            </ol>
                            <el-button type="button" class="btn btn-info d-none d-lg-block m-l-15" @click="addProductForm = true"><i class="fa fa-plus-circle"></i> Create New</el-button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <el-table
                        :data="products.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
                        :default-sort = "{prop: 'id', order: 'ascending'}"
                        border
                        style="width: 100%">
                            <el-table-column
                            fixed
                            prop="id"
                            label="ID"
                            sortable
                            resizable	
                            width="100">
                            </el-table-column>
                            <el-table-column
                            prop="image"
                            label="Image"
                            sortable
                            resizable
                            style="width:100px"
                            >
                            <template slot-scope="scope">
                                <img :src="scope.row.image" style="width:100%"/>
                            </template>
                            </el-table-column>
                            <el-table-column
                            prop="name"
                            label="Name"
                            sortable
                            resizable	
                            width="300">
                            </el-table-column>
                            <el-table-column
                            prop="price"
                            label="Price"
                            sortable
                            resizable	
                            width="300">
                            </el-table-column>
                            <el-table-column
                            prop="sale_price"
                            label="Sale Price"
                            sortable
                            resizable	
                            width="300">
                            </el-table-column>
                            <el-table-column
                            prop="brand.name"
                            label="Brand"
                            sortable
                            resizable	
                            width="300">
                            </el-table-column>
                            <el-table-column
                            prop="category.name"
                            label="Category"
                            sortable
                            resizable	
                            width="300">
                            </el-table-column>
                            <el-table-column
                            prop="sizes"
                            label="Size"
                            sortable
                            resizable	
                            width="300">
                                <template slot-scope="scope">
                                    <span v-for="item in scope.row.sizes">
                                        {{ proSize[item.size_id].name }}
                                    </span>
                                </template>
                            </el-table-column>
                            <el-table-column
                            prop="colors"
                            label="Color"
                            sortable
                            resizable	
                            width="300">
                                <template slot-scope="scope">
                                    <span v-for="item in scope.row.colors">
                                        {{ proColor[item.color].name }}
                                    </span>
                                </template>
                            </el-table-column>
                            <el-table-column
                            prop="description"
                            label="Description"
                            sortable
                            resizable	
                            width="300">
                            </el-table-column>
                            <el-table-column
                            prop="slug"
                            label="Slug"
                            sortable
                            resizable	
                            width="300">
                            </el-table-column>
                            <el-table-column
                            prop="status"
                            label="Status"
                            sortable
                            resizable	
                            width="500">
                            <template slot-scope="scope">
                                <span v-if="scope.row.status==1">
                                    Hiện
                                </span>
                                <span v-else>
                                    Ẩn
                                </span>
                            </template>
                            </el-table-column>
                            <el-table-column
                            align="right"
                            fixed="right">
                            <template slot="header" slot-scope="scope">
                                <el-input
                                v-model="search"
                                size="mini"
                                placeholder="Type to search"/>
                            </template>
                            <template slot-scope="scope">
                                <el-button  @click="deleteItem(scope.row.id)" type="text" size="small">Delete</el-button>
                                <el-button @click="formEdit(scope.row)" type="text" size="small">Edit</el-button>
                            </template>
                            </el-table-column>
                        </el-table>
                    </div>
                </div>
            </div>
        </div>
    </span>
</template>

<script>

import headTop from '../header.vue'
import sideBar from '../sidebar.vue'

export default {
    components:{
        headTop,
        sideBar
    },
    data: function(){
        return{
            addProductForm: false,
            editProductForm: false,
            brands:[],
            colors:[],
            categories:[],
            sizes:[],
            products:[],
            proSize: [],
            proColor:[],
            search: '',
            form:{
                name:'',
                price:'',
                sale_price:'',
                description:'',
                slug:'',
                image:'',
                imageDetail:'',
                category_id:'',
                brand_id:'',
                size_id:'',
                color_id:'',
                status:true,
            },
            editForm:{
                id: '',
                name:'',
                price:'',
                sale_price:'',
                description:'',
                slug:'',
                image:'',
                imageDetail:'',
                category_id:'',
                brand_id:'',
                size_id:[],
                color_id:[],
                status:true,
            },
            formLabelWidth: '150px',
        }
    },
    methods:{
        getList(){
            axios.get('http://localhost:8000/api/backend/products')
            .then(response=>{
                this.products = response.data;
            })
            .catch(error => {
                console.log(error);
            });
            // this.form = [''];
        },
        init(){
            axios.get('http://localhost:8000/api/backend/product/init')
            .then(response=>{
                this.categories = response.data[0];
                this.brands = response.data[1];
                this.sizes = response.data[2];
                this.colors = response.data[3];
                this.arrange();
            })
            .catch(error => {
                console.log(error);
            });
        },
        addItem(){
            console.log(this.form);
            if(this.form.name == ''){
                this.$notify({
                title: 'Lưu ý',
                message: 'Không được bỏ trống',
                type: 'warning'
                });
                return;
            }
            axios.post('http://localhost:8000/api/backend/product/store',{
                item: this.form,
            })
            .then(response=>{
                if(response.status == 200){
                    // this.item.name = "";
                    // this.$emit('reloadlist');
                    this.addProductForm = false;
                    this.$notify({
                    title: 'Thành công',
                    message: 'Thêm mới thành công',
                    type: 'success'
                    });
                    this.getList();
                    this.form.name = '';
                    this.form.size_id = [];
                    this.form.color_id = [];
                    this.form.imageDetail = '';
                    this.form.brand_id = '';
                    this.form.category_id = '';
                    this.form.price = '';
                    this.form.sale_price = '';
                    this.form.description = '';
                    this.form.slug = '';
                    this.form.image = '';
                    this.form.status = '';
                }
            })
            .catch(error=>{
                console.log(error);
                this.$message.error(error);
            })
        },
        arrange(){
            for(var i=0;i<this.sizes.length;i++){
                this.proSize[this.sizes[i].id] = this.sizes[i];
            }
            for(var i=0;i<this.colors.length;i++){
                this.proColor[this.colors[i].id] = this.colors[i];
            }
        },
        formEdit(data){
            console.log(data);
            this.editProductForm = true;
            this.editForm.name = data.name;
            this.editForm.size_id = [];
            this.editForm.color_id = [];
            this.editForm.imageDetail = '';
            for(var i = 0;i<data.sizes.length;i++){
                this.editForm.size_id[i] = data.sizes[i].size_id;
            }
            for(var i = 0;i<data.colors.length;i++){
                this.editForm.color_id[i] = data.colors[i].color;
            }
            for(var i = 0;i<data.images.length;i++){
                if(i!=0)
                    this.editForm.imageDetail+=' ';
                this.editForm.imageDetail += data.images[i].image;
            }
            this.editForm.brand_id = data.brand_id;
            this.editForm.category_id = data.category_id;
            this.editForm.price = data.price;
            this.editForm.sale_price = data.sale_price;
            this.editForm.description = data.description;
            this.editForm.slug = data.slug;
            this.editForm.image = data.image;
            this.editForm.status = (data.status) ? true : false;
            this.editForm.id = data.id;
            // console.log(this.editForm);
        },
        editItem(id){
            console.log(this.editForm);
            if(this.editForm.name == ''){
                this.$notify({
                title: 'Lưu ý',
                message: 'Không được bỏ trống',
                type: 'warning'
                });
                return;
            }
            axios.put('http://localhost:8000/api/backend/product/'+id,{
                item: this.editForm
            })
            .then(response=>{
                if(response.status == 200){
                    this.editProductForm = false;
                    this.$notify({
                    title: 'Thành công',
                    message: 'Chỉnh sửa thành công',
                    type: 'success'
                    });
                    this.getList();
                }
            })
            .catch(error=>{
                console.log(error);
                this.$message.error(error);
            })
            this.getList();
        },
        deleteItem(id){
            axios.delete('http://localhost:8000/api/backend/product/'+id)
            .then(response=>{
                if(response.status == 200){
                    this.$notify({
                    title: 'Thành công',
                    message: 'Xóa thành công',
                    type: 'success'
                    });
                    this.getList();
                }
            })
            .catch(error=>{
                console.log(error);
            })
        },
    },
    async created(){
        await this.init();
        await this.getList();
    }
}
</script>