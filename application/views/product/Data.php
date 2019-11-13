<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
  <style type="text/css">
    body{
      padding-top: 5rem;
    }
  </style>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body ng-app="App">
  <div class="container" ng-controller="productCtrl">
    <h3 class="page-header">Produk</h3>
    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#add_new_modal">Tambah</button>
    <hr>
    <table ng-if="products.length > 0" class="table table-hover table-striped">
            <tr>
               <th>No</th>
               <th>Kode</th>
               <th>Nama Produk</th>
               <th>Kategori</th>
               <th>Harga</th>
               <th>Stok</th>
               <th>#</th>
            </tr>
            <tr ng-repeat="x in products">
               <td>{{ $index }}</td>
               <td>{{ x.kd_prod }}</td>
               <td>{{ x.nm_prod }}</td>
               <td>{{ x.nm_kat }}</td>
               <td>{{ x.harga }}</td>
               <td>{{ x.stok }}</td>
               <td>
                  <button ng-click="edit($index)" class="btn btn-primary btn-xs">Ubah</button>
                  <button ng-click="delete(x.id_prod)" class="btn btn-danger btn-xs">Hapus</button>
               </td>
            </tr>
      </table>
      
      <div id="add_new_modal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          	<ul class="alert alert-danger" ng-if="errors.length > 0">
                  <li ng-repeat="error in errors">{{ error }}</li>
               </ul>
               <div class="form-group">
                  <label for="kd_prod">Kode</label>
                  <input type="hidden" ng-model="produk.id_prod">
                  <input ng-model="produk.kd_prod" type="text" class="form-control" placeholder="Kode"/>
               </div>
               <div class="form-group">
                  <label for="nm_prod">Nama Produk</label>
                  <input ng-model="produk.nm_prod" type="text" class="form-control" placeholder="Nama Produk"/>
               </div>
               <div class="form-group">
                  <label for="id_kat">Kategori</label>
                  <select class="form-control" ng-model="produk.id_kat">
                  	<option selected="selected">Pilih</option>
                  	<option ng-repeat="opt in kategori" value="{{opt.id_kat}}">{{opt.nm_kat}}</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="harga">Harga</label>
                  <input ng-model="produk.harga" type="text" class="form-control" placeholder="Harga"/>
               </div>
               <div class="form-group">
                  <label for="stok">Stok</label>
                  <input ng-model="produk.stok" type="text" class="form-control" placeholder="Stok"/>
               </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" ng-click="addProduct()" ng-disabled="disabledAdd">Simpan</button>
            <button type="button" class="btn btn-info" ng-click="updateProduct()" ng-disabled="disabledUpdate">Ubah</button>
            <button type="button" class="btn btn-secondary" ng-Click="Clear()" data-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container" ng-controller="Tes" id="tesid">
    <h5>Tes Angular CRUD</h5>
<br>
    <input class="id" type="text" ng-model="ins.id">
    <input type="text" class="form-control" ng-model="ins.nama" placeholder="Nama" id="nama">
    <input type="text" class="form-control" ng-model="ins.telp" placeholder="Telp" id="telp">
    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" ng-model="ins.jenis_kelamin">
      <option value="" selected="selected">Jenis Kelamin</option>
      <option ng-repeat="options in jk" value="{{ options.id }}">{{ options.nama }}</option>
    </select>
<br>
    <button class="btn btn-primary" ng-Click="tambah()">Add</button>
    <button id="nh" class="btn btn-success" ng-Click="anyar()">Update</button>
<br><br>
    <table class="table" ng-if="record.length > 0">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Telp</th>
        <th>Jenis Kelamin</th>
        <th>Action</th>
      </tr>
      <tr ng-repeat="z in record">
        <td>{{ $index }}</td>
        <td>{{ z.nama }}</td>
        <td>{{ z.telp }}</td>
        <td>{{ z.jk }}</td>
        <td>
          <button class="btn btn-success" ng-Click="editin($index)">Edit</button>
          <button class="btn btn-danger" ng-Click="del(z.id)">Hapus</button>
        </td>
      </tr>
    </table>
  </div>

  <script type="text/javascript" src="<?php echo base_url();?>angular/angular.min.js"></script>
  
  <script type="text/javascript">

  // Restricts input for the given textbox to the given inputFilter.
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}

  // Install input filters.
  setInputFilter(document.getElementById("telp"), function(value) {
  return /^\d*$/.test(value); });

    var app = angular.module('App', []);

    app.controller('Tes', function($scope,$http){

      $("#nh").hide();

      $scope.errors = [];
      $scope.record = [];
      $scope.ins = {};
      $scope.jk;

        $scope.Clear=function() {
          $('input').val('');
          $('select').val('');
        }

//===================Fungsi Tampilkan Data
        $scope.showdata = function(){
          $http({
            method : 'get',
            url : '<?php echo site_url('product/show/')?>',
          }).then(function success(z){
            $scope.record = z.data;
          },function error(z){
            //alert('Error');
            console.log(z.data);
          })
          
        };
//===================Fungsi Tampilkan Data

//===================Fungsi Tambah
        $scope.tambah = function(){
          //alert('z');
          var nm = $('#nama').val();
          var telp = $('#telp').val();
          if(nm == ""){
            alert('nama kosong');
          }else if(telp == ""){
            alert('Telp Kosong');
          }else{
            $http({
              method : 'post',
              url : '<?php echo site_url('product/tambah')?>',
              data :{ins: $scope.ins}
            }).then(function success(z){
              //result disini
              //console.log(z.data);
              $scope.Clear();
              $scope.showdata();

            },function error(z){
              console.log(z.data, z.error);
            });
          }

        };

        $scope.editin = function(index){
            $scope.ins = $scope.record[index];
            $('#nh').show();
        }
//===================Fungsi Tambah

//===================Fungsi Update
        $scope.anyar= function(){
          //alert('a');
          
            $http({
              method : 'post',
              url : '<?php echo site_url('product/updatein')?>',
              data : {ins:$scope.ins}
            }).then(function success(z){
              console.log(z.data);
              $scope.Clear();
              $scope.showdata();
              
            })
        }

        $scope.updateProduct=function() {
        $http({
            method: 'POST',
            url:  '<?php echo site_url('product/update/')?>',
            data :{produk: $scope.produk}
          }).then(function success(e) {
              $scope.errors = [];
              var modal_element = angular.element('#add_new_modal');
              modal_element.modal('hide');
              //window.location.reload();
              $scope.getProduct();
          }, function error(e) {
            $scope.errors = e.data.errors;
          });
        }
//===================Fungsi Update

//===================Fungsi Delete

        $scope.del = function(id){
          var yakin = confirm('Yakin Hapus !');
          if(yakin == true){

            $http({
              method : 'post',
              url : '<?php echo site_url('product/hapus')?>',
              data : {id:id}
            }).then(function succes(z){
              console.log(z.data);
              $scope.showdata();
            })

          }else{

          }
          
        }
//===================Fungsi Delete

        $scope.jk = function(){
          $http({
            method : 'get',
            url : '<?php echo site_url('product/get_jk')?>'
          }).then(function success(z){
            console.log(z.data);
            $scope.jk = z.data;
          }, function error(z){
            console.log(z.data, z.error);
          })
        }



        $scope.showdata();
        $scope.jk();
        

    });

    //------------------------------------------------------------------------------------------------------------------//

    app.controller('productCtrl', function($scope,$http){

      $scope.errors = [];
      $scope.products = []; //List Produk
      $scope.produk = {}; //Object
      $scope.kategori;
      $scope.disabledAdd=false;
      $scope.disabledUpdate=true;

      $scope.getCategory = function() {
        $http({
          method: 'GET',
          url: '<?php echo site_url('product/get_category/')?>'
          }).then(function success(e) {
          $scope.kategori = e.data;
          }, function error(e) {
          console.log(e.data,e.error);
        });
      };

      $scope.getCategory();

      $scope.getProduct = function() {
        $http({
          method: 'GET',
          url: '<?php echo site_url('product/get_all/')?>'
        }).then(function succes(e) {
          $scope.products = e.data;
        }, function error(e) {
          console.log(e.data,e.error);
        });
      };

      $scope.addProduct=function() {

        $http({
            method: 'POST',
            url:  '<?php echo site_url('product/insert/')?>',
            data :{produk: $scope.produk}
          }).then(function success(e) {
              $scope.errors = [];
              $scope.products.push(e.data.produk);
              var modal_element = angular.element('#add_new_modal');
              modal_element.modal('hide');
              //window.location.reload();
              $scope.getProduct();
          }, function error(e) {
            $scope.errors = e.data.errors;
          });

      }

      $scope.updateProduct=function() {
      $http({
          method: 'POST',
          url:  '<?php echo site_url('product/update/')?>',
          data :{produk: $scope.produk}
        }).then(function success(e) {
            $scope.errors = [];
            var modal_element = angular.element('#add_new_modal');
            modal_element.modal('hide');
            //window.location.reload();
            $scope.getProduct();
        }, function error(e) {
          $scope.errors = e.data.errors;
        });
      }

      $scope.edit = function (index) {
        $scope.produk = $scope.products[index];
        $scope.disabledAdd=true;
        $scope.disabledUpdate=false;
        var modal_element = angular.element('#add_new_modal');
        modal_element.modal('show');
      };

      $scope.delete=function(id_prod) {
      var conf = confirm("Yakin mau menghapus !!");
        if (conf == true) {
          $http({
              method: 'POST',
              url:  '<?php echo site_url('product/delete/')?>',
              data: { ID : id_prod }
            }).then(function success(e) {
              //window.location.reload();
              $scope.getProduct();
            }, function error(e) {
              $scope.errors = e.data.errors;
              console.log(e.data,e.errors);
          });
        }
      }

      $scope.getProduct();

      $scope.Clear=function() {
        $('input').val('');
        $('select').val('');
      }

    });

  </script>
</body>
</html>