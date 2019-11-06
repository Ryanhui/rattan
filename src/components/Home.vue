<template>
  <div class="body-wrapper">
    <div>
      <el-carousel height="450px">
        <el-carousel-item v-for="item in photos" :key="item">
          <img :src="item" width="1168">
        </el-carousel-item>
      </el-carousel>
      <el-row class="body-content-wrapper">
          <el-col :span="18">
           <div class="body-content introduction">
            <p class="introductio-text"> 
              Rattan is the name for roughly 600 species of old world climbing palms 
              belonging to subfamily Calamoideae. More than 5 million people depend 
              economically on rattan, and approximately 7 billion US dollars per year 
              are made in the rattan industry, including domestic industrial production, 
              the international cane Trade, cane splitting, plaiting materials, baskets, 
              seats, and furniture. With the release of two rattan genomes in 2018, their 
              functional analysis were put on the agenda. Rattan-NET is a open rattan 
              co-expression network database with a range of analytical tools. Rattan-NET 
              provided functional annotations of genes in rattans for researchers. 
              Specifically, it annotated genes in transcriptome level and offered 
              functional modules by co-expression analysis. More data sets and tools 
              will be loaded during the movement of Genome Atlas of Bamboo and Rattan 
              (GABR) project. Special thanks to the help of the <a class="lab" target="_blank" href="http://systemsbiology.cau.edu.cn/ZhenSuLab/index_e.html">Zhen Su's Lab</a> in Rattan-NET construction. 
              </p>
              <!-- <p style="text-align: left;padding-left: 64px;margin-top: 12px;">Citation: </p>
              <p class="citation">
                Peng Z, Lu Y, Li L, Zhao Q, Feng Q, Gao Z, et al. The draft genome of the fast-growing non-timber forest species moso bamboo (Phyllostachys heterocycla). Nature genetics. 2013;45(4):456-61, 61e1-2. doi: 10.1038/ng.2569. 
                <a href="https://www.nature.com/articles/ng.2569">Link</a>
              </p>
              <p class="citation">
                Zhao H, Peng Z, Fei B, Li L, Hu T, Gao Z, et al. BambooGDB: a bamboo genome database with functional annotation and an analysis platform. Database : the journal of biological databases and curation. 2014;2014:bau006. doi: 10.1093/database/bau006. 
                <a href="https://academic.oup.com/database/article/doi/10.1093/database/bau006/2633777">Link</a>
              </p>
              <p class="citation">Zhao H, Gao Z, Wang L, Wang J, Wang S, Fei B, et al. Chromosome-level reference genome and alternative splicing atlas of moso bamboo (Phyllostachys edulis). Gigascience. 2018;7(10). doi: 10.1093/gigascience/giy115. 
                <a href="https://academic.oup.com/gigascience/article-lookup/doi/10.1093/gigascience/giy115">Link</a>
              </p> -->
           </div>
          </el-col>
         <el-col :span="6">
           <div class="body-content news" ref="scriptHolder">
              <div style="height: 330px;line-height: 330px">
                There are news
              </div>
              <a href="https://www.revolvermaps.com/livestats/5pplwzj355p/"><img src="//rf.revolvermaps.com/h/m/a/0/ff0000/128/0/5pplwzj355p.png" width="256" height="128" alt="Map" style="border:0;"></a>
           </div>
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MainBody',
  components:{
    
  },
  data: function (){ 
    return {
      photos: {
        photo1: require('../assets/photo1.jpg'),
        photo2: require('../assets/photo2.jpg'),
        photo3: require('../assets/photo3.jpg'),
        photo4: require('../assets/photo4.jpg')
      }
    }
  },
}
</script>

<style>
  .body-wrapper {
    background: white;
    padding-bottom: 16px;
  }
  .body-content {
    background: rgba(40, 241, 40, 0.2);
    height: 470px;
  }
  .introduction {
    margin-right: 8px;
    /* background: url('../assets/bamboo_facebook.png') center no-repeat; */
  }
  .el-carousel {
    margin: 16px 0 8px 0;
  }
  .body-content-wrapper {
    margin: 0 16px;
  }
  .introductio-text {
    font-size: 22px;
    padding: 24px 64px;
    text-align: justify;
  }
  .citation {
    font-size: 14px;
    padding: 8px 64px;
    text-align: justify;
  }
  .citation a{
    text-decoration: none;
    color:rgb(9, 160, 84);
  }
  .lab {
    text-decoration: none;
    color: rgb(0, 131, 87);
  }
</style>

