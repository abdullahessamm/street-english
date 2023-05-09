<script src="https://unpkg.com/survey-jquery@1.9.34/survey.jquery.min.js"></script>
<script>
Survey.StylesManager.applyTheme("defaultV2");

window.survey = new Survey.Model({!! $survey_json_data !!});

$("#surveyElement").Survey({model: survey});

// Use onComplete to get survey.data to pass it to the server.
survey.onComplete.add(function (sender) {
    var mySurvey = sender;
    var surveyData = sender.data;

    console.log(surveyData);
});
</script>