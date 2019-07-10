import Home from './components/Home.vue'
import Gbrowser1 from './components/Gbrowser1.vue';
import Gbrowser2 from './components/Gbrowser2.vue';
import Blast from './components/Blast.vue';
import Download from './components/Download.vue';
import Contact from './components/Contact.vue';

import CoExpression from './components/tools/CoExpression.vue';

export default [
  { path: '/', component: Home },
  { path: '/gbrowser1', component: Gbrowser1 },
  { path: '/gbrowser2', component: Gbrowser2 },
  { path: '/blast', component: Blast },
  { path: '/download', component: Download },
  { path: '/contact', component: Contact },

  {path: '/tools/coexpression', component: CoExpression}
]