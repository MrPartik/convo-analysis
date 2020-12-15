library(shiny)
library(ggplot2)  # for the diamonds dataset
library(RMySQL)
library(plotly)
library(RColorBrewer)
#library( "ggplot2" )
options(shiny.host = '192.168.31.163')
options(shiny.port = 5677)
con <- dbConnect(MySQL(), user ='root',host ='localhost', dbname = 'convo_analysis')

ui <- fluidPage(
    title = "Programs",
    fluidRow(
        plotOutput("plot")
    ),
    fluidRow(
        sidebarLayout(
            sidebarPanel(
                conditionalPanel(
                    'input.dataset === "dbcon"',
                    helpText("Click on charts to drilldown.")
                )
            ),
            mainPanel(
                tabsetPanel(
                    id = 'dataset',
                    tabPanel("dbcon", DT::dataTableOutput("mytable4"))
                )
            )
        )
    )
)

server <- function(input, output) {
    
    dbcon <- dbGetQuery(con, "SELECT CITY, COUNT(*) TOTAL FROM R_PROGRAM AS PROGRAM INNER JOIN R_HEI AS HEI ON PROGRAM.CODE = HEI.CODE GROUP BY CITY")
    # customize the length drop-down menu; display 5 rows per page by default
    output$mytable4 <- DT::renderDataTable({
        DT::datatable(dbcon, options = list(lengthMenu = c(5, 30, 50)))
    })
    output$plot <- renderPlot({
        coul <- brewer.pal(5, "Set2") 
        df<-as.data.frame(dbcon)
        xLabel <-df$CITY
        plotThis <- #ggplot( data=dbcon, aes( x=x_lbl, y=y_lbl ) ) + geom_bar( fill="lightblue", stat="identity" ) + xlab( "Programs" ) + ggtitle( "Number of Programs Per City" )
            barplot(dbcon$TOTAL, main="Number of Programs Per Region",  xlab="Region", ylab="Count",  names=xLabel, col=coul)
    })
    
}

shinyApp(ui, server)
