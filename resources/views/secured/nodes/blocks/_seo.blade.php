<!-- SEO Fields -->
<div class="col-12" style="margin-bottom: 20px;">
    <div class="row">
        <div class="col-6">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">SEO English</h6>
                <div class="form-group">
                    <label for="seoTitleEn">SEO Title</label>
                    <input type="text" class="form-control" id="seoTitleEn" name="seoTitleEn"
                           placeholder="Input catalog SEO title" autocomplete="off"
                           value="{{ isset($node) ? $node->n_title_en : '' }}">
                </div>
                <div class="form-group">
                    <label for="seoDescriptionEn">SEO Description</label>
                    <textarea class="form-control" id="seoDescriptionEn" name="seoDescriptionEn">{{ isset($node) ? $node->n_description_en : '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">SEO Arabic</h6>
                <div class="form-group">
                    <label for="seoTitleAr">SEO Title</label>
                    <input type="text" class="form-control" id="seoTitleAr" name="seoTitleAr"
                           placeholder="Input catalog SEO title"
                           autocomplete="off" value="{{ isset($node) ? $node->n_title_ar : '' }}">
                </div>
                <div class="form-group">
                    <label for="seoDescriptionAr">SEO Description</label>
                    <textarea class="form-control" id="seoDescriptionAr" name="seoDescriptionAr">{{ isset($node) ? $node->n_description_ar : '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End SEO Fields -->