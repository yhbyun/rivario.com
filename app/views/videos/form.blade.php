
<?php
$page_title = "Video Upload";
?>

@include('partials._page-title')

@section('styles')
<style>
.dropzone {
  min-height:200px;
  border: none;
  background: rgba(255, 255, 255, 1);
}
body {
  background: white!important;
}
</style>
@stop

@section('scripts')
<script>
Dropzone.options.dropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 100, // MB
  maxFiles: 1,
  init: function() {
    this.on("success", function(file, response) {
      var scope = angular.element($("#video-ctrl")).scope();
      scope.$apply(function() {
        scope.data = response;
      });
    });
  }
};

angular.module("myApp", [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>')
  })
  .controller("videoCtrl", ['$scope',
    function ($scope) {
      $scope.data = {
        video: '',
        thumbnail: []
      };

      $('#preview-video').show();
  }]);

</script>
@stop

@section('content')
{{ Form::open(['action' => 'VideosController@store', 'method' => 'post', 'class' => 'dropzone', 'id' => 'dropzone']) }}
{{ Form::close() }}

<div id="preview-video" ng-app="myApp" style="display:none">
  <div class="container" id="video-ctrl" ng-controller="videoCtrl">
    <div class="row">
      <div class="col-xs-12 text-center">
        <video src="<%data.video%>" controls ng-if="data.video"/>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-4" ng-repeat="thumbnail in data.thumbnail">
        <img src="<%thumbnail%>" class="img-responsive thumbnail" />
      </div>
    </div>
  </div>
</div>
@stop
