<aside class="main-sidebar">

    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => Yii::t('app', 'Painel de Navegação'), 'options' => ['class' => 'header']],
//                        ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
//                        ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                        [
                            'label' => 'Gerir Clientes',
                            'icon' => 'user',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Listagem de Clientes', 'icon' => 'user', 'url' => ['cliente/index'],],
//                                [
//                                    'label' => 'Level One',
//                                    'icon' => 'circle-o',
//                                    'url' => '#',
//                                    'items' => [
//                                        ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                        [
//                                            'label' => 'Level Two',
//                                            'icon' => 'circle-o',
//                                            'url' => '#',
//                                            'items' => [
//                                                ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                                ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ],
//                                        ],
//                                    ],
//                                ],
                            ],
                        ],
                        [
                            'label' => 'Inscrições',
                            'icon' => 'file-text',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Musculação', 'icon' => 'hand-rock-o', 'url' => ['inscricao/musculacao'],],
                                ['label' => 'Aulas', 'icon' => 'bicycle', 'url' => ['inscricao/aulas'],],
                            ],
                        ],
                        [
                            'label' => 'Sessão',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Listagem de Sessões', 'icon' => 'user', 'url' => ['sessao/listar-sessoes'],],
                            ],
                        ],
                        [
                            'label' => 'Aulas',
                            'icon' => 'bicycle',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Listagem de Aulas', 'icon' => 'list', 'url' => ['aula/index'],],
                            ],
                        ],
                        [
                            'label' => 'Mensalidades',
                            'icon' => 'motorcycle',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Listagem de Mensalidades', 'icon' => 'list', 'url' => ['modalidade/index'],],
                            ],
                        ],
                        [
                            'label' => 'Sala',
                            'icon' => 'building',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Listagem de Salas', 'icon' => 'list', 'url' => ['sala/index'],],
                            ],
                        ],
                        [
                            'label' => 'Professor',
                            'icon' => 'graduation-cap',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Listagem de Professores', 'icon' => 'list', 'url' => ['professor/index'],],
                            ],
                        ],
                        [
                            'label' => 'Planos',
                            'icon' => 'calendar',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Planos de Exercícios',
                                    'icon' => 'male',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Listagem de Planos', 'icon' => 'list', 'url' => ['plano/index'],],
                                        ['label' => 'Listagem Planos de Treino', 'icon' => 'bars', 'url' => ['planoexercicio/index'],],
                                    ],
                                ],
                                [
                                    'label' => 'Planos de Nutrição',
                                    'icon' => 'apple',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Listagem de Planos', 'icon' => 'list', 'url' => ['planon/index'],],
                                        ['label' => 'Listagem de Nutrição', 'icon' => 'bars', 'url' => ['planonutricao/index'],],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'label' => 'Galerias',
                            'icon' => 'picture-o',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Superior', 'icon' => 'file-image-o', 'url' => ['galeriasuperior/index'],],
                                ['label' => 'Inferior', 'icon' => 'file-image-o', 'url' => ['galeriainferior/index'],],
                            ],
                        ],
                        [
                            'label' => 'Produtos',
                            'icon' => 'product-hunt',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Listagem de Produtos', 'icon' => 'list', 'url' => ['produto/index'],],
                                [
                                    'label' => 'Categoria',
                                    'icon' => 'list-alt',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Listar Categorias', 'icon' => 'list', 'url' => ['categoriaproduto/index'],],
                                    ],
                                ],
                                [
                                    'label' => 'Subcategoria',
                                    'icon' => 'th-list',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Listar Subcategorias', 'icon' => 'list', 'url' => ['subcategoriaproduto/index'],],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
        )
        ?>
    </section>
</aside>
