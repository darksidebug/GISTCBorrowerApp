    <div class="container details">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $i = 1;
                    foreach ($data as $key => $value) {
                        ?>
                            <label for="" id="line_numbering">
                                <?php
                                    echo $i++;
                                ?>
                            </label>
                            <div class="container-fluid label__top">
                                <div class="labeled">
                                    <h4 for="" id="transact_type">
                                        <span id="">
                                            <?php
                                                echo $value->transact_type;
                                            ?>
                                        </span>
                                    </h4><br>
                                    <label for="">ID NUMBER:
                                        <span id="id">
                                            <?php
                                                echo $value->ID_num;
                                            ?>
                                        </span>
                                    </label><br>
                                    <label for="">NAME:
                                        <span id="name">
                                            <?php
                                                echo $value->name;
                                            ?>
                                        </span>
                                    </label><br>
                                    <label for="">DEPT:
                                        <span id="dept">
                                            <?php
                                                echo $value->dept;
                                            ?>
                                        </span>
                                    </label><br>
                                    <label for="">CONTACT:
                                        <span id="contact">
                                            <?php
                                                echo $value->contact;
                                            ?>
                                        </span>
                                    </label><br>
                                    <label for="">DATE BORROWED:
                                        <span id="date_borrowed">
                                            <?php
                                                echo $value->date_borrowed;
                                            ?>
                                        </span>
                                    </label>
                                </div>
                                <div class="detailed">
                                    <label for="">DATE TO RETURN:
                                        <span id="date_to_return">
                                            <?php
                                                echo $value->date_to_returned;
                                            ?>
                                        </span>
                                    </label><br>
                                    <label for="">ITEM NAME:
                                        <span id="item_name">
                                            <?php
                                                echo $value->item_name;
                                            ?>
                                        </span>
                                    </label><br>
                                    <label for="">SERIAL/CODE:
                                        <span id="code">
                                            <?php
                                                echo $value->code;
                                            ?>
                                        </span>
                                    </label><br>
                                    <label for="">MODEL NUM:
                                        <span id="model">
                                            <?php
                                                echo $value->model_num;
                                            ?>
                                        </span>
                                    </label><br>
                                    <label for="">QUANTITY:
                                        <span id="quantity">
                                            <?php
                                                echo $value->quantity;
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>