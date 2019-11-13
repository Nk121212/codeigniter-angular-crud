<!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>

    <style type="text/css">

      body{
        padding-top: 5rem;
      }

    </style>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <body ng-app="App"> <!-- load controller di body ng-app -->
        
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
            <td>{{ z.jns }}</td>
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
      ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event){
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

      $scope.Clear=function(){
        $('input').val('');
        $('select').val('');
      }

      //===================Fungsi Tampilkan Data
      $scope.showdata = function(){
        $http({
          method : 'get',
          url : '<?php echo site_url('C_tes_angular/show/')?>',
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
            url : '<?php echo site_url('C_tes_angular/tambah')?>',
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
      $scope.anyar = function(){
        //alert('a');
        $http({
          method : 'post',
          url : '<?php echo site_url('C_tes_angular/updatein')?>',
          data : {ins:$scope.ins}
        }).then(function success(z){
          console.log(z.data);
          $scope.Clear();
          $scope.showdata();

        })
      }
      //===================Fungsi Update

      //===================Fungsi Delete

      $scope.del = function(id){
        var yakin = confirm('Yakin Hapus !');
        if(yakin == true){

          $http({
            method : 'post',
            url : '<?php echo site_url('C_tes_angular/hapus')?>',
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
          url : '<?php echo site_url('C_tes_angular/get_jk')?>'
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

      </script>


    </body>

</html>