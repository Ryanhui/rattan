import Home from './components/Home.vue'
import Gbrowser1 from './components/Gbrowser1.vue';
import Gbrowser2 from './components/Gbrowser2.vue';
import Blast from './components/Blast.vue';
import Download from './components/Download.vue';
import Contact from './components/Contact.vue';
import AnnotationSummary from './components/AnnotationSummary.vue';

import CoExpression from './components/tools/CoExpression.vue';
import GeneSetsAnalysis from './components/tools/GeneSetsAnalysis.vue';
import ModuleEnrichment from './components/tools/ModuleEnrichment.vue';

export default [
  { path: '/', component: Home },
  { path: '/gbrowser1', component: Gbrowser1 },
  { path: '/gbrowser2', component: Gbrowser2 },
  { path: '/blast', component: Blast },
  { path: '/download', component: Download },
  { path: '/contact', component: Contact },
  { path: '/annotationsummary', component: AnnotationSummary},

  {path: '/tools/coexpression', component: CoExpression},
  {path: '/tools/genesetsanalysis', component: GeneSetsAnalysis},
  {path: '/tools/moduleenrichment', component: ModuleEnrichment}
]