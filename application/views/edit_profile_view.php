<?php $this->load->view('template/header');?>
<link href=' <?php echo base_url();?>assets/css/user-quiz.css' rel='stylesheet' type='text/css'>
<link href=' <?php echo base_url();?>assets/css/cropper.css' rel='stylesheet' type='text/css'>
<div id="main-container" data-reload-on-logout="1">
    <div id="quiz-container-title"><span id="quiz-container-title-label">Edit Profile</span><span id="quiz-draft-mode-label" style="display:none">DRAFT MODE</span><span id="quiz-hidden-label" style="display:none">HIDDEN</span><span id="quiz-premium-label" style="display:none">PREMIUM</span></div>
    <div id="quiz-container" class="">
        <div id="quiz-tabs-container">
            <button class="theme-active-button quiz-tab quiz-tab-4" id="quiz-tab-info">PERSONAL INFO</button>
            <button class="theme-passive-button quiz-tab quiz-tab-4" id="quiz-tab-questions">ADDRESS INFO</button>
            <button class="theme-passive-button quiz-tab quiz-tab-4" id="quiz-tab-results">CONTACT INFO</button>
            <button class="theme-passive-button quiz-tab quiz-tab-4" id="quiz-tab-results">CHANGE PASSWORD</button>
        </div>
        <div id="quiz-info-container" class="quiz-tab-content">
            <div class="quiz-image"><i class="fa fa-picture-o quiz-image-placeholder" data-image-type="quiz"></i></div><!--
            --><div class="quiz-text">
                <input type="text" id="quiz-title" placeholder="First Name" autocomplete="off" maxlength="90" />
                <input type="text" id="quiz-title" placeholder="Quiz Title" autocomplete="off" maxlength="90" />
                <input type="text" id="quiz-title" placeholder="Quiz Title" autocomplete="off" maxlength="90" />
                <textarea id="quiz-description" placeholder="Quiz Description" autocomplete="off" maxlength="150"></textarea>
                <select id="quiz-type" autocomplete="off">
                    <option value="1">Quiz Type - Each question has one correct option</option>
                    <option value="2">Quiz Type - Assign weights to each option</option>
                </select>
                <select id="quiz-language" autocomplete="off">
                    <option value="en-US" data-direction="ltr" selected>Quiz Language - English (US)</option>            </select>
                </div>
                <div id="quiz-title-textcount" class="quiz-textcount">0 / 90</div>
                <div id="quiz-description-textcount" class="quiz-textcount">0 / 150</div>
            </div>

            <!-- Quiz Results Container -->
            <div id="quiz-results-container" class="quiz-tab-content">
                <div id="quiz-single-result-container">
                    <div class="quiz-result-image"><i class="fa fa-picture-o quiz-image-placeholder" data-image-type="result"></i></div><!--
                    --><div class="quiz-result-text">
                        <input type="text" id="quiz-result-title" placeholder="Result Title" autocomplete="off" maxlength="100" />
                        <textarea id="quiz-result-description" placeholder="Result Description" autocomplete="off" maxlength="200"></textarea>
                    </div>
                    <div id="quiz-result-title-textcount" class="quiz-textcount">0 / 100</div>
                    <div id="quiz-result-description-textcount" class="quiz-textcount">0 / 200</div>
                </div>
                <div id="quiz-results-container-footer">
                    <div id="quiz-results-buttons-container">
                        <button class="theme-active-button-small quiz-result-button" data-result-no="1">Less than 25%</button>
                        <button class="theme-passive-button-small quiz-result-button" data-result-no="2">25% - 50%</button>
                        <button class="theme-passive-button-small quiz-result-button" data-result-no="3">51% - 75%</button>
                        <button class="theme-passive-button-small quiz-result-button" data-result-no="4">More than 75%</button>
                    </div>
                </div>
            </div>


                <!-- Quiz Images Upload Lightbox -->
                <div id="quiz-images-lightbox">
                    <div id="quiz-images-container">
                        <div id="quiz-images-upload-container">
                            <div id="quiz-images-upload-title" class="theme-light-background theme-light-background-color theme-light-background-border">UPLOAD IMAGE</div>
                            <div id="quiz-images-upload-dimenson">
                                <div class="theme-light-background-color" id="quiz-images-option-type-upload-dimenson">Minimum dimensions of image should be 180 x 180</div>
                                <div class="theme-light-background-color" id="quiz-images-other-type-upload-dimenson">Minimum dimensions of image should be 600 x 325</div>
                            </div>
                        </div>
                        <input type="file" id="quiz-image-file" />
                        <div id="quiz-image-new-container">
                            <div id="quiz-image-new-header">CROP IMAGE</div>
                            <div id="quiz-image-new-subheader">Drag to reposition , Use mousewheel to zoon in & out</div>
                            <div id="quiz-cropper-container">
                                <img id="quiz-image-new" />
                            </div>
                            <div id="quiz-image-new-buttons">
                                <input type="text" id="quiz-image-new-attribution" placeholder="Image Credits / Attribution" autocomplete="off" /><!--
                                --><button id="quiz-image-new-save" class="theme-active-button">Save</button>
                            </div>
                            <div id="quiz-image-new-no-attribution-container">
                                <input type="checkbox" id="quiz-image-new-no-attribution" autocomplete="off" /><label for="quiz-image-new-no-attribution">No attribution required</label>
                            </div>
                        </div>
                    </div>
                    <i id="quiz-images-lightbox-close" class="fa fa-remove"></i>
                </div>
                <!-- Quiz Image Attribution Lightbox -->
                <div id="quiz-image-attribution-lightbox">
                    <div id="quiz-image-old-container">
                        <div>
                            <img id="quiz-image-old" />
                        </div>
                        <div id="quiz-image-old-buttons">
                            <input type="text" id="quiz-image-old-attribution" placeholder="Image Credits / Attribution" /><!--
                            --><button id="quiz-image-old-save" class="theme-active-button">Save</button>
                        </div>
                        <div id="quiz-image-old-no-attribution-container">
                            <input type="checkbox" id="quiz-image-old-no-attribution" /><label for="quiz-image-old-no-attribution">No attribution required</label>
                        </div>
                    </div>
                    <i id="quiz-image-attribution-lightbox-close" class="fa fa-remove"></i>
                </div>
                <!-- Quiz Error Lightbox -->
                <div id="quiz-error-dialog-container">
                    <div id="quiz-error-dialog">
                        <div id="quiz-error-dialog-title"></div>
                    <ul id="quiz-error-dialog-list"></ul>
                    <button id="quiz-error-dialog-close" class="theme-active-button">Got it</button>
                </div>
            </div>
        </div>
<!--         <div id="quiz-publish-buttons-container">
            <button id="publish-quiz-button" class="theme-active-button" data-in-progress="0">
            <span id="publish-quiz-button-1" style="">PUBLISH QUIZ</span>
            <span id="publish-quiz-button-2" style="display:none">UPDATE QUIZ</span>
            </button>
            <button id="save-draft-button" class="theme-active-button" data-in-progress="0" style="">SAVE DRAFT</button>
        </div> -->
        <div id="quiz-image-uploaded-container-template">
            <div class="quiz-image-uploaded-container">
                <img />
                <div class="quiz-image-delete"><i class="fa fa-trash"></i></div>
                <div class="quiz-image-edit"><i class="fa fa-pencil-square-o"></i></div>
                <div class="quiz-image-upload"><i class="fa fa-upload"></i></div>
            </div>
        </div>
        <div id="quiz-image-upload-error-templates">
            <div id="quiz-image-upload-size-error" class="quiz-image-upload-error theme-error-background">Error : Maximum size of image can be 1 MB</div>
            <div id="quiz-image-upload-extension-error" class="quiz-image-upload-error theme-error-background">Error : Only JPEG, PNG & GIF allowed</div>
            <div id="quiz-image-upload-dimension-error" class="quiz-image-upload-error theme-error-background">Error : Minimum dimensions of image should be 600 x 325</div>
            <div id="quiz-image-upload-dimension-option-error" class="quiz-image-upload-error theme-error-background">Error : Minimum dimensions of image should be 180 x 180</div>
        </div>
        <div id="quiz-question-link-template">
            <button class="theme-active-button-small quiz-question-link"></button>
        </div>
        <div id="quiz-button-loader-template">
            <i class="fa fa-spin fa-spinner quiz-button-loader-icon"></i>
        </div></div>
        <script>

    LANGUAGE_CODE_CURRENT = 'en-US',
    MAX_IMAGE_SIZE_ALLOWED_MB = '1',
    PRETTY_URLS = '1',
    IS_DEFAULT_LANGUAGE = '1',
    LOCATION_SITE = 'index.html';

</script>
        <script src=" <?php echo base_url();?>assets/js/cropper.min.js"></script>
        <script src=" <?php echo base_url();?>assets/js/tooltipsy.min.js"></script>
        <script src=" <?php echo base_url();?>assets/js/user-quiz.js"></script>
        <script>
    var new_quiz = new NewQuiz($("#quiz-container"), 1, null, null, null, 0);
</script>
        <?php $this->load->view('template/footer');?>