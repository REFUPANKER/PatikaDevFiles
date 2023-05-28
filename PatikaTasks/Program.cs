namespace PatikaDevCSharp
{
    class PatikaTasks : FastCommands
    {
        static void Main(string[] args)
        {
            try
            {
                Console.Clear();
                cwls("App started\n");
                TasksHolder tasks = new TasksHolder();
            }
            catch (System.Exception excp)
            {
                cwls(excp);
            }
            finally
            {
                cwls("\nApp ended");
            }
        }
    }
}