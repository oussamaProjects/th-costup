<template>
  <div class="alert-cookie out bg-custom_red text-white shadow">
    <div class="inner">
      <p class="scrolling copy">
        {{ message }}
      </p>
      <p class="scrolling copy">
        {{ message }}
      </p>
      <p class="scrolling copy">
        {{ message }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: ["message"],
};
</script>

<style>
.alert-cookie {
  z-index: 909;
  visibility: visible;
  position: absolute;
  min-height: 30px;
  padding-top: 4px;
  padding-bottom: 4px;
  line-height: 30px;
  width: 100%;
  text-align: center;
  opacity: 1;
  transform: translateY(-100%);
  transition: transform 0.3s ease-out, opacity 0.1s ease 0.2s,
    visibility 0s linear 0.3s;
  bottom: 0;
  font-size: 15px;
}

.alert-cookie .container {
  position: relative;
  padding: 5px 0;
}
.alert-cookie .inner {
  margin:0 8px;
  display: flex;
  overflow: hidden;
} 
.alert-cookie .scrolling {
  padding: 0;
  margin: 0;
  white-space: nowrap;
  animation: scrolling-anim 15s linear infinite;
}

.alert-cookie .scrolling span { 
  font: 400 14px "Courier Prime";
}

.alert-cookie .scrolling .svg {
  width: 14px;
  margin: 0 !important;
  vertical-align: inherit;
  display: inline-block;
}

.alert-cookie .scrolling span a {
  display: inline;
}
.alert-cookie .scrolling img {
  vertical-align: baseline;
  display: inline-block;
}
@keyframes scrolling-anim {
  0% {
    transform: translate3d(0, 0, 0);
  }
  100% {
    transform: translate3d(-100%, 0, 0);
  }
}
</style>