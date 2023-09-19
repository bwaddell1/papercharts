import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import Underline from '@editorjs/underline';
import Code from '@editorjs/code';
import InlineCode from '@editorjs/inline-code';
import Quote from '@editorjs/quote';
import Paragraph from 'editorjs-paragraph-with-alignment';
import NestedList from '@editorjs/nested-list';
import Checklist from '@editorjs/checklist';
import ColorPlugin from 'editorjs-text-color-plugin';
import { StyleInlineTool } from 'editorjs-style';
// import ImageTool from '@editorjs/image';

window.editorInstance = function (dataProperty, editorId, readOnly, placeholder, logLevel) {
    return {
        instance: null,
        data: null,

        initEditor() {
            this.data = this.$wire.get(dataProperty);

            this.instance = new EditorJS({
                holder: editorId,

                readOnly,

                placeholder,

                logLevel,

                tools: {
                    // image: {
                    //     class: ImageTool,

                    //     config: {
                    //         uploader: {
                    //             uploadByFile: (file) => {
                    //                 return new Promise((resolve) => {
                    //                     this.$wire.upload(
                    //                         'uploads',
                    //                         file,
                    //                         (uploadedFilename) => {
                    //                             const eventName = `fileupload:${uploadedFilename.substr(0, 20)}`;

                    //                             const storeListener = (event) => {
                    //                                 resolve({
                    //                                     success: 1,
                    //                                     file: {
                    //                                         url: event.detail.url
                    //                                     }
                    //                                 });

                    //                                 window.removeEventListener(eventName, storeListener);
                    //                             };

                    //                             window.addEventListener(eventName, storeListener);

                    //                             this.$wire.call('completedImageUpload', uploadedFilename, eventName);
                    //                         }
                    //                     );
                    //                 });
                    //             },

                    //             uploadByUrl: (url) => {
                    //                 return this.$wire.loadImageFromUrl(url).then(result => {
                    //                     return {
                    //                         success: 1,
                    //                         file: {
                    //                             url: result
                    //                         }
                    //                     }
                    //                 });
                    //             }
                    //         }
                    //     }
                    // },
                    list: {
                        class: NestedList,
                        inlineToolbar: true,
                        config: {
                            defaultStyle: 'unordered'
                        },
                    },
                    header: {
                        class: Header,
                        config: {
                            levels: [1, 2],
                        },
                    },
                    underline: Underline,
                    // code: Code,
                    // 'inline-code': InlineCode,
                    // quote: Quote,
                    // warning: Warning,
                    paragraph: {
                        class: Paragraph,
                        inlineToolbar: true,
                    },
                    checklist: {
                        class: Checklist,
                        inlineToolbar: true,
                    },
                    Color: {
                        class: ColorPlugin, // if load from CDN, please try: window.ColorPlugin
                        config: {
                            colorCollections: ['#EC7878', '#9C27B0', '#673AB7', '#3F51B5', '#0070FF', '#03A9F4', '#00BCD4', '#4CAF50', '#8BC34A', '#CDDC39', '#FFF'],
                            defaultColor: '#FF1300',
                            type: 'text',
                            customPicker: true // add a button to allow selecting any colour  
                        }
                    },
                    // style: StyleInlineTool,
                },

                data: this.data,

                onChange: () => {
                    this.instance.save().then((outputData) => {
                        this.$wire.set(dataProperty, outputData);

                        this.$wire.call('save');
                    }).catch((error) => {
                        console.log('Saving failed: ', error)
                    });
                }
            });
        }
    }
}
