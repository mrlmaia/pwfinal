 <?php 
 #ingredientereceitaform
 if (!empty($_SESSION['ingredientes'])):	
                                    foreach($_SESSION['ingredientes'] as $key => $registro): ?>
                                        <tr> 
                                            <td>
                                                <?php echo $registro->getNome()?>
                                            </td>
                                            <td>
                                                <?php echo $registro->getPreco()?>
                                            </td>
                                            <td>
                                                <?php echo $registro->getQuantidade()?>
                                            </td>
                                            <td>
                                                <?php echo ($registro->getPreco())?>
                                            </td>
                                            <td>
                                                <td> 
                                                    <a class='btn btn-outline-danger float-right mx-1' onclick="doPost('formulario', 'excluir')">Excluir</a> 
                                                </td>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                endif;
                            ?>

                             <!-- Modal -->
                        <div class="modal fade" id="modalAddIngrediente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form-modal" action="ingredienteProdutoAcao.php" method="post">
                                            <div class="form-group">
                                                <label for="ingredientes">Ingredientes</label>
                                                <select class="form-control" id="ingrediente" name="ingredienteSelecionado">
                                                <?php /*  
                                                        if (isset($todosIngredientes)):	
                                                            foreach($todosIngredientes as $key => $registro): ?> ?>
                                                                <option value="<?php echo $registro->getId()?>">
                                                                    <?php echo $registro->getNome()?>
                                                                </option>
                                                            <?php endforeach;
                                                        endif; */
                                                    ?>
                                                </select>
                                            </div>
                                        </form>   
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary" onclick="doPost('form-modal', 'adicionar')">Adidionar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fecha modal -->