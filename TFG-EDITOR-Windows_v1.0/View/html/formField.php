<?php if(isset($formField)) { ?>
    <div class="input-container">
        <?php if($formField['type'] === "file") { ?>
            <input id="<?php echo $formField['id'] ?>" name="<?php echo $formField['id'] ?>[]"
                   class="custom-file-input" type="<?php echo $formField['type'] ?>"
                   <?php echo $formField['required'] ?> multiple/>
            <label for="<?php echo $formField['id'] ?>" class="custom-file-label"><?php echo $formField['placeholder'] ?></label>
        <?php } else { ?>
            <?php if($formField['type'] === "textarea") { ?>
                <textarea id="<?php echo $formField['id'] ?>" class='input text-input'
                          name="<?php echo $formField['id'] ?>" type="text" rows="<?php echo $formField['rows'] ?>"
                          <?php echo $formField['required'] ?> placeholder=" "><?php echo $formField['value'] ?></textarea>
            <?php } else if($formField['type'] === "selector") { ?>
                <select id="<?php echo $formField['id'] ?>" class="input" name="<?php echo $formField['name'] ?>"
                    <?php echo $formField['required'] ?>
                    <?php echo $formField['multiple']? 'multiple='.$formField['multiple']: "" ?>
                    <?php echo $formField['value']? 'value='.$formField['value']: "" ?>>
                    <?php foreach ($formField['options'] as $option) { ?>
                        <option value="<?php echo $option['id'] ?>">
                            <?php echo $option['title'] ?>
                        </option>
                    <?php } ?>
                </select>
            <?php } else { ?>
                <input id="<?php echo $formField['id'] ?>" name="<?php echo $formField['id'] ?>"
                       class="input <?php echo $formField['inputClasses'] ?>" type="<?php echo $formField['type'] ?>"
                    <?php echo $formField['required'] ?> placeholder=" "
                    <?php echo $formField['maxlength']? 'maxlength='.$formField['maxlength']: "" ?>
                    <?php echo $formField['minlength']? 'minlength='.$formField['minlength']: "" ?>
                    <?php echo $formField['max']? 'max='.$formField['max']: "" ?>
                    <?php echo $formField['min']? 'min='.$formField['min']: "" ?>
                    <?php echo $formField['multiple']? 'multiple': "" ?>
                    <?php echo $formField['value']? 'value='.$formField['value']: "" ?>>
            <?php } ?>
            <div class="cut"></div>
            <label for="<?php echo $formField['id'] ?>" class="placeholder <?php echo $formField['labelClasses'] ?>">
                <?php echo $formField['placeholder'] ?>
            </label>
        <?php } ?>
    </div>
<?php } ?>
