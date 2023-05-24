<?php

$adminPanelPath = trans('siteConfig.path.adminPanel');

$config = [

    'adminPanel' => [

        'general' => [

            'css' => [
                $adminPanelPath.'/app-assets/css/vendors.min.css',
                $adminPanelPath.'/app-assets/css/app.min.css',
                // $adminPanelPath.'/app-assets/css/core/menu/menu-types/horizontal-menu.min.css',
                $adminPanelPath.'/app-assets/css/core/menu/menu-types/vertical-menu.min.css',

                $adminPanelPath.'/app-assets/css/core/colors/palette-gradient.min.css',
                $adminPanelPath.'/app-assets/css/core/colors/palette-callout.min.css',
                $adminPanelPath.'/app-assets/fonts/simple-line-icons/style.min.css',
                $adminPanelPath.'/app-assets/vendors/css/extensions/toastr.css',
                $adminPanelPath.'/app-assets/css/plugins/extensions/toastr.min.css',
                $adminPanelPath.'/assets/css/style.css',
                // $adminPanelPath.'/css/ideaecom.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/vendors.min.js',
                $adminPanelPath.'/app-assets/vendors/js/ui/jquery.sticky.js',
                $adminPanelPath.'/app-assets/js/core/app-menu.min.js',
                $adminPanelPath.'/app-assets/js/core/app.min.js',
                $adminPanelPath.'/app-assets/vendors/js/extensions/toastr.min.js',
                $adminPanelPath.'/app-assets/js/scripts/extensions/toastr.min.js',
                $adminPanelPath.'/app-assets/js/scripts/popover/popover.min.js',
                $adminPanelPath.'/app-assets/js/scripts/customizer.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    'component.CustomJS.toastr'
                ]
            ]

        ],

        'sweetalert' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/extensions/sweetalert.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/extensions/sweetalert.min.js',
                $adminPanelPath.'/app-assets/js/scripts/extensions/sweet-alerts.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'chats' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css',
                $adminPanelPath.'/app-assets/vendors/css/charts/morris.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/charts/jquery.sparkline.min.js',
                $adminPanelPath.'/app-assets/vendors/js/charts/chart.min.js',
                $adminPanelPath.'/app-assets/vendors/js/charts/raphael-min.js',
                $adminPanelPath.'/app-assets/vendors/js/charts/morris.min.js',
                $adminPanelPath.'/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js',
                $adminPanelPath.'/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js',
                $adminPanelPath.'/app-assets/data/jvector/visitor-data.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],
        
        'chartist' => [

            'css' => [
                $adminPanelPath.'/app-assets/fonts/meteocons/style.min.css',
                $adminPanelPath.'/app-assets/vendors/css/charts/morris.css',
                $adminPanelPath.'/app-assets/vendors/css/charts/chartist.css',
                $adminPanelPath.'/app-assets/vendors/css/charts/chartist-plugin-tooltip.css',
                $adminPanelPath.'/app-assets/css/pages/dashboard-ecommerce.min.css',
            ],
            'js' => [
                
                $adminPanelPath.'/app-assets/vendors/js/charts/chartist.min.js',
                $adminPanelPath.'/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js',
                $adminPanelPath.'/app-assets/vendors/js/charts/raphael-min.js',
                $adminPanelPath.'/app-assets/vendors/js/charts/morris.min.js',
                $adminPanelPath.'/app-assets/js/scripts/pages/dashboard-ecommerce.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],
        
        'chartjs' => [

            'css' => [
                '',
            ],
            'js' => [
                
                $adminPanelPath.'/app-assets/js/scripts/charts/chartjs/bar/bar.min.js',
                $adminPanelPath.'/app-assets/js/scripts/charts/chartjs/bar/bar-stacked.min.js',
                $adminPanelPath.'/app-assets/js/scripts/charts/chartjs/bar/bar-multi-axis.min.js',
                $adminPanelPath.'/app-assets/js/scripts/charts/chartjs/bar/column.js',
                $adminPanelPath.'/app-assets/js/scripts/charts/chartjs/bar/column-stacked.min.js',
                $adminPanelPath.'/app-assets/js/scripts/charts/chartjs/bar/column-multi-axis.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'dashboard-sales' => [

            'css' => [
                ''
            ],
            'js' => [
                $adminPanelPath.'/app-assets/js/scripts/pages/dashboard-sales.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'breadcrumbs' => [

            'css' => [
                ''
            ],
            'js' => [
                $adminPanelPath.'/app-assets/js/scripts/ui/breadcrumbs-with-stats.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'icheck' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/forms/icheck/icheck.css',
                $adminPanelPath.'/app-assets/vendors/css/forms/icheck/custom.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/forms/icheck/icheck.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'login-register' => [

            'css' => [
                $adminPanelPath.'/app-assets/css/pages/login-register.min.html',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/js/scripts/forms/form-login-register.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'validation' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/forms/icheck/icheck.css',
                $adminPanelPath.'/app-assets/vendors/css/forms/icheck/custom.css',
                $adminPanelPath.'/app-assets/css/plugins/forms/validation/form-validation.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/icheck/icheck.min.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/toggle/switchery.min.js',
                $adminPanelPath.'/app-assets/js/scripts/forms/validation/form-validation.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/tags/form-field.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'datatable' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/tables/datatable/datatables.min.css',
                $adminPanelPath.'/app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css',
                $adminPanelPath.'/app-assets/vendors/css/tables/extensions/colReorder.dataTables.min.css',
                $adminPanelPath.'/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css',
                $adminPanelPath.'/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css',
                $adminPanelPath.'/app-assets/vendors/css/tables/extensions/fixedHeader.dataTables.min.css'
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/tables/datatable/datatables.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/buttons.colVis.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/datatable/dataTables.colReorder.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/jszip.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/pdfmake.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/vfs_fonts.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/buttons.html5.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/buttons.print.min.js',
                $adminPanelPath.'/app-assets/vendors/js/tables/datatable/dataTables.select.min.js',

                $adminPanelPath.'/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    'component.CustomJS.datatable.datatable'
                ]
            ]

        ],

        'switch-checkbox' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css',
                $adminPanelPath.'/app-assets/css/plugins/forms/switch.min.css',
                $adminPanelPath.'/app-assets/css/core/colors/palette-switch.min.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js',
                $adminPanelPath.'/app-assets/js/scripts/forms/switch.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'switchery-checkbox' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/forms/toggle/switchery.min.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/toggle/switchery.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'select2' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/forms/selects/select2.min.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/forms/select/select2.full.min.js',
                $adminPanelPath.'/app-assets/js/scripts/forms/select/form-select2.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'file-input-button' => [

            'css' => [
                $adminPanelPath.'/css/FileInputButton.css',
            ],
            'js' => [
                $adminPanelPath.'/js/FileInputButton.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],
        
        'input-mask' => [

            'css' => [
                $adminPanelPath.'/app-assets/css/plugins/forms/extended/form-extended.min.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/forms/extended/typeahead/typeahead.bundle.min.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/extended/typeahead/bloodhound.min.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/extended/typeahead/handlebars.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/extended/formatter/formatter.min.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/extended/maxlength/bootstrap-maxlength.js',
                $adminPanelPath.'/app-assets/vendors/js/forms/extended/card/jquery.card.js',

                $adminPanelPath.'/app-assets/js/scripts/forms/extended/form-typeahead.min.js',
                $adminPanelPath.'/app-assets/js/scripts/forms/extended/form-inputmask.min.js',
                $adminPanelPath.'/app-assets/js/scripts/forms/extended/form-formatter.min.js',
                $adminPanelPath.'/app-assets/js/scripts/forms/extended/form-maxlength.min.js',
                $adminPanelPath.'/app-assets/js/scripts/forms/extended/form-card.min.js'
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'tab' => [

            'css' => [
                '',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/js/scripts/navs/navs.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'jquery-collapse-tab' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/ui/jquery-ui.min.css',
                $adminPanelPath.'/app-assets/css/plugins/ui/jqueryui.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js',
                $adminPanelPath.'/app-assets/js/scripts/ui/jquery-ui/navigations.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'jquery-date-pickers' => [

            'css' => [
                ''
            ],
            'js' => [
                $adminPanelPath.'/app-assets/js/scripts/ui/jquery-ui/date-pickers.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'dragula' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/extensions/dragula.min.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/extensions/dragula.min.js',
                $adminPanelPath.'/app-assets/js/scripts/extensions/drag-drop.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'checkboxes-radios' => [

            'css' => [
                $adminPanelPath.'/app-assets/css/plugins/forms/checkboxes-radios.min.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/js/scripts/forms/checkbox-radio.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'datetime-picker' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/pickers/daterange/daterangepicker.css',
                $adminPanelPath.'/app-assets/vendors/css/pickers/pickadate/pickadate.css',
                $adminPanelPath.'/app-assets/css/plugins/pickers/daterange/daterange.min.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/pickers/pickadate/picker.js',
                $adminPanelPath.'/app-assets/vendors/js/pickers/pickadate/picker.date.js',
                $adminPanelPath.'/app-assets/vendors/js/pickers/pickadate/picker.time.js',
                $adminPanelPath.'/app-assets/vendors/js/pickers/pickadate/legacy.js',
                $adminPanelPath.'/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js',
                $adminPanelPath.'/app-assets/vendors/js/pickers/daterange/daterangepicker.js',
                //$adminPanelPath.'/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'summernote' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/editors/summernote.css',
                $adminPanelPath.'/app-assets/vendors/css/editors/codemirror.css',
                $adminPanelPath.'/app-assets/vendors/css/editors/theme/monokai.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/editors/codemirror/lib/codemirror.js',
                $adminPanelPath.'/app-assets/vendors/js/editors/codemirror/mode/xml/xml.js',
                $adminPanelPath.'/app-assets/vendors/js/editors/summernote/summernote.js',
                //$adminPanelPath.'/app-assets/js/scripts/editors/editor-summernote.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'ecommerce-cart' => [

            'css' => [
                $adminPanelPath.'/app-assets/css/pages/ecommerce-cart.min.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/js/scripts/pages/ecommerce-cart.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

        'product' => [

            'css' => [
                ''
            ],
            'js' => [
                ''
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    'brand.components.CustomJS.product-js'
                ]
            ]

        ],

        'dropzone' => [

            'css' => [
                $adminPanelPath.'/app-assets/vendors/css/file-uploaders/dropzone.min.css',
                $adminPanelPath.'/app-assets/css/plugins/file-uploaders/dropzone.min.css',
            ],
            'js' => [
                $adminPanelPath.'/app-assets/vendors/js/extensions/dropzone.min.js',
                $adminPanelPath.'/app-assets/js/scripts/extensions/dropzone.min.js',
            ],
            'include' => [
                'css' => [
                    ''
                ],
                'js' => [
                    ''
                ]
            ]

        ],

    ],


];

return $config;
