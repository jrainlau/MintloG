<template>
	<div id='vue-region'>
		<input type="text">
    <div class="region-container">
      <ul class="r-province">
        <li v-for='i in proList.proName.length'>
          {{proList.proName[i]}}
        </li>
      </ul>
      <ul class="r-city">
        <li>666</li>
      </ul>
      <ul class="r-district">
        <li>6666</li>
      </ul>
    </div>
	</div>
</template>

<script>
import district from '../../lib/district.js'

function getProvince () {
  var proArr = {
    proName: [],
    proNum: []
  }
  for (var i = 0, plength = district.length; i < plength; i++) {
    proArr.proName[i] = district[i].province
    proArr.proNum[i] = i
  }
  return proArr
}

function getCity (proNum) {
  var cityArr = {
    cityName: [],
    cityNum: []
  }
  for (var j = 0, clength = district[proNum].cityArr.length; j < clength; j++) {
    cityArr.cityName[j] = district[proNum].cityArr[j].city
    cityArr.cityNum[j] = j
  }
  return cityArr
}

function getDis (proNum, cityNum) {
  var disArr = {
    disName: [],
    disNum: []
  }
  for (var k = 0, dlength = district[proNum].cityArr[cityNum].districtArr.length; k < dlength; k++) {
    disArr.disName = district[proNum].cityArr[cityNum].districtArr
    disArr.disNum = k
  }
  return disArr
}

export default {
  data: function () {
    return {
      proList: getProvince(),
      proSelect: '',
      cityList: '',
      citySelect: '',
      disList: '',
      disSelect: '',
      locDetail: '',
      showPane: 0
    }
  }
}
</script>

<style lang=less>
  #vue-region {
    position: relative;
    border: 1px solid #000;
    .region-container {
      position: absolute;
      top: 45px;
      background: #fff;
      ul {
        float: left;
        padding: 15px 0 15px 15px;
        width: 160px;
        border: 1px solid #000;
        list-style: none;
        &:nth-child(2), &:nth-child(3) {
          border-left: none;
        }
        li {
          position: relative;
          padding: 5px;
          &:hover,
          &:focus {
            border: 1px solid #000;
            border-right-color: #fff;
            left:1px;
            z-index: 10;
          }
        }
      }
    }
  }
</style>