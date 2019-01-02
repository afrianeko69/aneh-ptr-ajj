var joobleAPI = {
     urlAPI: ''
    ,keyAPI: ''
    ,keywords: ''
    ,location: ''
    ,radius: '' //(0, 8, 16, 24, 40, 80) km
    ,salary: 0
    ,searchMode: 3

    ,idResultBox:'joobleVacancy'
    ,idPagingBox:'jooblePageing'
    ,idNumVacancy: 'joobleNumVacancy'
    ,idInputKeywords:'joobleKeyword'
    ,idInputLocation:'joobleLocation'
    ,idInputRadius:'joobleRadius'
    ,idInputSalary:'joobleSalary'
    ,idInputSearchMode:'joobleSearchMode'
    ,idInputCountry:'joobleCountry'
    ,idInputKey:'joobleKey'
    ,idInputVacancyOnPage:'joobleVacancyOnPage'
    ,idInputCharsAroundCurrentPage:'joobleCharsAroundCurrentPage'
    ,idWaitMessage:'joobleWaitMessage'

    ,isTitle:1
    ,isLocation:1
    ,isSnippet:1
    ,isSalary:1
    ,isSource:1
    ,isCompany:1
    ,isUpdated:1

    ,vacancyOnPage:4
    ,charsAroundCurrentPage:2
    ,currentPage:1
    ,cntResults:0
    ,arrJobs:[]
    ,waitMessage:'Please wait a moment while we\'re retrieving the job listings'

    ,newSearch: function(){
        this.urlAPI = 'https://' + document.getElementById(this.idInputCountry).value + '.jooble.org/api/';
        if(document.getElementById(this.idInputKeywords)){
            this.keywords = document.getElementById(this.idInputKeywords).value;
        }
        if(document.getElementById(this.idInputLocation)){
            this.location = document.getElementById(this.idInputLocation).value;
        }
        if(document.getElementById(this.idInputRadius)){
            this.radius = document.getElementById(this.idInputRadius).value;
        }
        if(document.getElementById(this.idInputSalary)){
            this.salary = document.getElementById(this.idInputSalary).value;
        }
        if(document.getElementById(this.idInputSearchMode)){
            this.searchMode = document.getElementById(this.idInputSearchMode).value;
        }
        if(document.getElementById(this.idInputKey)){
            this.keyAPI = document.getElementById(this.idInputKey).value
        }
        if(document.getElementById(this.idInputVacancyOnPage)){
            this.vacancyOnPage = Number(document.getElementById(this.idInputVacancyOnPage).value);
        }
        if(document.getElementById(this.idInputCharsAroundCurrentPage)){
            this.charsAroundCurrentPage = Number(document.getElementById(this.idInputCharsAroundCurrentPage).value);
        }
        if(document.getElementById(this.idWaitMessage)){
            this.waitMessage = document.getElementById(this.idWaitMessage).value;
        }
        if(document.getElementById('joobleIsTitle')){
            this.isTitle = document.getElementById('joobleIsTitle').value;
        }
        if(document.getElementById('joobleIsLocation')){
            this.isLocation = document.getElementById('joobleIsLocation').value;
        }
        if(document.getElementById('joobleIsSnippet')){
            this.isSnippet = document.getElementById('joobleIsSnippet').value;
        }
        if(document.getElementById('joobleIsSalary')){
            this.isSalary = document.getElementById('joobleIsSalary').value;
        }
        if(document.getElementById('joobleIsSource')){
            this.isSource = document.getElementById('joobleIsSource').value;
        }
        if(document.getElementById('joobleIsCompany')){
            this.isCompany = document.getElementById('joobleIsCompany').value;
        }
        if(document.getElementById('joobleIsUpdated')){
            this.isUpdated = document.getElementById('joobleIsUpdated').value;
        }


        this.currentPage = 1; 
        this.arrJobs = [];

        this.loadNewVacancy(JSON.stringify(this.genQuery()), true);
    }

    ,genQuery: function(){
        var parameters = {
             keywords:this.keywords
            ,location:this.location
            ,page:Math.ceil(this.arrJobs.length / 20) + 1
            ,radius:this.radius
            ,salary:this.salary == '' ? 0 : this.salary
            ,searchMode:this.searchMode == '' ? 3 : this.searchMode
        };
        return parameters;
    }


    ,loadNewVacancy: function(parameters, isShowNow){
        var japi = this;
        var http = new XMLHttpRequest();
        http.open("POST", this.urlAPI + this.keyAPI, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send(parameters);
        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                japi.putNewVacancy(JSON.parse(http.responseText));
                if(isShowNow){japi.showResults();}            
            }
        }
    }

    ,putNewVacancy: function(obj){
        this.cntResults = obj.totalCount;
        for(var key in obj.jobs) {
            this.arrJobs.push(obj.jobs[key]);
        }
    }

    ,showResults: function(){
        var cvp = this.vacancyOnPage * this.currentPage;
        //load and show
        if(cvp > this.arrJobs.length && cvp <= this.cntResults){
            this.loadNewVacancy(JSON.stringify(this.genQuery()), true);
            document.getElementById(this.idResultBox).innerHTML = this.waitMessage;
            return false; 
        }else if(cvp + this.vacancyOnPage > this.arrJobs.length 
&& cvp + this.vacancyOnPage <= this.cntResults
/*this.cntResults - this.arrJobs.length > 0*/){
            this.loadNewVacancy(JSON.stringify(this.genQuery()), false);
        }

        // number of vacancy
        if(document.getElementById(this.idNumVacancy))
        {
            var novFirstChild = document.getElementById(this.idNumVacancy).firstChild;
            var novSecondChild = novFirstChild.nextSibling.nextSibling;

            novFirstChild.innerHTML = this.genNumVacancy();
            novSecondChild.innerHTML = this.cntResults;
        }

        // vacancy
        document.getElementById(this.idResultBox).innerHTML = null;
        document.getElementById(this.idResultBox).appendChild(
            this.genVacancyBox(
                  this.arrJobs
                , this.vacancyOnPage * (this.currentPage - 1)
                , this.vacancyOnPage * this.currentPage));

        // paging
        if(document.getElementById(this.idPagingBox)){
            document.getElementById(this.idPagingBox).appendChild(this.genPagingBox());
        }
    }

    ,genNumVacancy: function(){
        var from = (this.currentPage * this.vacancyOnPage) - this.vacancyOnPage + 1 ;
        var to = this.currentPage * this.vacancyOnPage;
        if(to > this.cntResults) to = this.cntResults;
        return from + '-' + to;
    }

    ,genVacancyBox: function(arr, from, to){

        var vacancyBox = document.createElement('article'); //vacancy box

        for(var i = from; i < to ;i++ )
        {
            if(arr[i] !== undefined){
                var vacancy = arr[i];
            }else{
                break;
            }

			if(vacancy.title === undefined) break;
			
            //Title
            var titleP = document.createElement('p');
            titleP.className = 'jooble jblTitle';

            var titpleA = document.createElement('a');
            titpleA.setAttribute('href', vacancy.link);
            //titpleA.setAttribute('target', 'blank');
            titpleA.innerHTML = vacancy.title;
            titleP.appendChild(titpleA);

            vacancyBox.appendChild(titleP);

            //Location
            if(vacancy.location !== undefined && vacancy.location !== '' && this.isLocation == 1) {
                var location = document.createElement('p');
                location.className = 'jooble jblLocation';
                location.innerHTML = vacancy.location;
                vacancyBox.appendChild(location);
            }

            //Description
            if(vacancy.snippet !== undefined && vacancy.snippet !== '' && this.isSnippet == 1) {
                var descP = document.createElement('p');
                descP.className = 'jooble jblDescription';
                descP.innerHTML = vacancy.snippet;
                vacancyBox.appendChild(descP);
            }

            //Salary
            if(vacancy.salary !== undefined && vacancy.salary !== '' && this.isSalary == 1) {
                var salaryP = document.createElement('p');
                salaryP.className = 'jooble jblSalary';
                salaryP.innerHTML = vacancy.salary
                vacancyBox.appendChild(salaryP);
            }
            //Company name
            if(vacancy.company !== undefined && vacancy.company !== '' && this.isCompany == 1) {
                var companyP = document.createElement('p');
                companyP.className = 'jooble jblCompany';
                companyP.innerHTML = vacancy.company
                vacancyBox.appendChild(companyP);
            }
            
        }

        return vacancyBox;
    }


    ,changePage: function(value){
        this.currentPage = value;
        this.showResults();
    }

    ,genPagingBox: function(){
        var charsAroundCurrentPage = this.charsAroundCurrentPage;
        var maxPage = Math.ceil(this.cntResults / this.vacancyOnPage);

        var firstPage = this.currentPage - charsAroundCurrentPage;
        var lastPage = this.currentPage + charsAroundCurrentPage;
        var previousPage = this.currentPage <= 1 ? 1 : this.currentPage - 1;
        var nextPage =  this.currentPage >= maxPage ? 1 : this.currentPage + 1;

        if(firstPage <= 0){
            firstPage = 1;
            lastPage += charsAroundCurrentPage - this.currentPage + 1;

            if(lastPage > maxPage){
                lastPage = maxPage;
            }
        }

        if(lastPage > maxPage){
            lastPage = maxPage;
            firstPage -= charsAroundCurrentPage - (maxPage -  this.currentPage);

            if(firstPage <= 0){
                firstPage = 1;
            } 
        }

        var box = document.createElement('ul');
        var li = document.createElement('li');
        var a = document.createElement('a');
        a.innerHTML = '<';

        if(this.currentPage == 1){
            li.setAttribute('id','jblInactivePage');
        }else{
            a.setAttribute('onclick','joobleAPI.changePage(' + previousPage + ')');
        }

        li.appendChild(a)
        box.appendChild(li);

        for(var i = firstPage; i <= lastPage ;i++ )
        {
            
            li = document.createElement('li');
            if(i == this.currentPage){
                li.setAttribute('id','jblCurrentPage');
            }

            a = document.createElement('a');
            a.setAttribute('onclick','joobleAPI.changePage(' + i + ')');
            a.innerHTML = i;

           li.appendChild(a)
            box.appendChild(li);
        }

        li = document.createElement('li');
        a = document.createElement('a');
         a.innerHTML = '>';

        if(this.currentPage == maxPage){
            li.setAttribute('id','jblInactivePage');
        }else{     
            a.setAttribute('onclick','joobleAPI.changePage(' + nextPage + ')');
        }
        
        li.appendChild(a);
        box.appendChild(li);

        document.getElementById(this.idPagingBox).innerHTML = null;

        return box;
    }

};

joobleAPI.newSearch();