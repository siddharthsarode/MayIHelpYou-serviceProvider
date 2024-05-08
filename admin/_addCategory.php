<body>
    <div class="add-service-container form-container" id="add-service">
        <div class="service-box">
            <div class="form-box">
                <div class="form-heading">
                    <h2 class="heading">Add Category</h2>
                </div>
                <form id="add-category-form" autocomplete="off">
                    <div class="form-element">
                        <label class="form-label" for="serviceName">Category Name</label>
                        <input class="form-input" type="text" name="serviceName" id="serviceName"
                            placeholder="Category Name" />
                    </div>
                    <div class="form-element">
                        <button class="form-input button submit-btn" id="submit">Add Now</button>
                    </div>
                    <div class="service-response">
                        <span id="response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./js/_addCategory.js"></script>
</body>