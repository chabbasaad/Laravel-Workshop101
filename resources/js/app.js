import './bootstrap';


import Editor from '@toast-ui/editor';
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';

if(document.querySelector('#editor')) {
const editor = new Editor({
  el: document.querySelector('#editor'),
  height: '400px',
  initialEditType: 'markdown',
  placeholder: 'Write something cool!',
});

//console.log(document.querySelector('#content').value);

editor.setMarkdown(document.querySelector('#content').value);


document.querySelector('#sendForm').addEventListener('submit', e => {
    e.preventDefault();
    console.log(editor.getMarkdown());

    document.querySelector('#content').value = editor.getMarkdown();
    e.target.submit();
  });

}