import Home from './components/Home.vue'
import Gbrowser1 from './components/Gbrowser1.vue';
import Gbrowser2 from './components/Gbrowser2.vue';
import Blast from './components/Blast.vue';
import Download from './components/Download.vue';
import Contact from './components/Contact.vue';
import AnnotationSummary from './components/AnnotationSummary.vue';
import FunctionModule from './components/FunctionModule.vue';
import FunctionModuleDetail from './components/FunctionModuleDetail.vue';

import GeneFunctionSearch from './components/search/GeneFunctionSearch.vue';

import CoExpression from './components/tools/CoExpression.vue';
import GeneSetsAnalysis from './components/tools/GeneSetsAnalysis.vue';
import ModuleEnrichment from './components/tools/ModuleEnrichment.vue';
import CisElementAnalysis from './components/tools/CisElementAnalysis.vue';
import SequenceExtractor from './components/tools/SequenceExtractor';
import CisElementAnalysisResult from './components/tools/CisElementAnalysisResult.vue';
import NetworkModuleComparison from './components/tools/NetworkModuleComparison';
import NetworkModuleComparisonOneGene from './components/tools/NetworkModuleComparison/NetworkModuleComparisonOneGene';
import NetworkModuleComparisonGeneResult from './components/tools/NetworkModuleComparison/NetworkModuleComparisonGeneResult';
import NetworkModuleComparisonOneModule from './components/tools/NetworkModuleComparison/NetworkModuleComparisonOneModule';
import NetworkModuleComparisonModuleResult from './components/tools/NetworkModuleComparison/NetworkModuleComparisonModuleResult';

import Search from './components/Search.vue';

export default [
  { path: '/', component: Home },
  { path: '/gbrowser1', component: Gbrowser1 },
  { path: '/gbrowser2', component: Gbrowser2 },
  { path: '/blast', component: Blast },
  { path: '/download', component: Download },
  { path: '/contact', component: Contact },
  { path: '/annotationsummary', component: AnnotationSummary},
  { path: '/search', component: Search},
  { path: '/function_module/:gene', name:'FunctionModule', component: FunctionModule},
  { path: '/function_module_detail/moudle1/:module1/module2/:module2', name:'FunctionModuleDetail', component: FunctionModuleDetail},

  { path: '/gene_function_search/gene/:gene/species/:species', name:'GeneFunctionSearch', component: GeneFunctionSearch},

  {path: '/tools/coexpression', component: CoExpression},
  {path: '/tools/genesetsanalysis', component: GeneSetsAnalysis},
  {path: '/tools/moduleenrichment', component: ModuleEnrichment},
  {path: '/tools/ciselementanalysis', component: CisElementAnalysis},
  {path: '/tools/cis_element_analysis_result', name:'CisElementAnalysisResult', component: CisElementAnalysisResult, props: (route) => ({query: route.query.jobid})},
  {path: '/tools/sequenceextractor', component: SequenceExtractor},
  {path: '/tools/network_module_comparison', component: NetworkModuleComparison},
  {path: '/tools/network_module_comparison_one_gene', name: 'NetworkModuleComparisonOneGene', component: NetworkModuleComparisonOneGene, props: (route) => ({geneA: route.query.geneA})},
  {path: '/tools/network_module_comparison_gene_result', name: 'NetworkModuleComparisonGeneResult', component: NetworkModuleComparisonGeneResult, props: (route) => ({geneA: route.query.geneA, geneB:route.query.geneB})},
  {path: '/tools/network_module_comparison_one_module', name: 'NetworkModuleComparisonOneModule', component: NetworkModuleComparisonOneModule, props: (route) => ({moduleA: route.query.moduleA})},
  {path: '/tools/network_module_comparison_module_result', name: 'NetworkModuleComparisonModuleResult', component: NetworkModuleComparisonModuleResult, props: (route) => ({moduleA: route.query.moduleA, moduleB:route.query.moduleB})},

]