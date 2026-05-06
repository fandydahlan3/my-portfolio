<template>
  <div class="card mt-23">
    <div class="card-body">
      <h4 class="card-title">About Me</h4>
      <div class="row">
        <div class="Icons col-3" v-for="icon in icons" :key="icon">
          <div class="card mb-2 border border-light">
            <div class="card-body">
              <vue-feather :type="icon.name"></vue-feather> {{icon.name}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="./_Icons.js" lang="js"></script>
